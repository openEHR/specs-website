<?php
/** @noinspection PhpReturnValueOfMethodIsNeverUsedInspection */
/** @noinspection PhpUnnecessaryCurlyVarSyntaxInspection */

namespace App\Domain\Service;

use App\Context;
use App\Domain\Data\Expression;
use App\Domain\Data\Release;
use App\Domain\Data\Component;
use App\Helper\File;

class ComponentService
{

    /** @var array */
    protected array $data;

    public function __construct(protected Context $appContext)
    {
        $file = $this->getCacheFile();
        /** @noinspection UnserializeExploitsInspection */
        if (!is_readable($file) || !($data = file_get_contents($file)) || !($this->data = unserialize($data))) {
            $this->build();
        }
    }

    private function getCacheFile(): string
    {
        return "{$this->appContext->cacheDir}/ComponentService.sdata";
    }

    /**
     * @throws \JsonException
     * @throws \DomainException
     */
    public function build(): ComponentService
    {
        $this->data = [
            'components' => [],
            'releases' => [],
            'expressions' => [],
        ];
        foreach (glob("{$this->appContext->releasesDir}/*/latest/manifest.json") as $file) {
            if (is_readable($file) && ($content = file_get_contents($file)) && ($data = json_decode($content, true, 512, JSON_THROW_ON_ERROR))) {
                $component = (new Component($this->appContext))($data);
                $this->registerComponent($component);
            }
        }
        $this->buildComponents();
        $this->buildReleases();
        $this->buildExpressions();
        $this->buildTypes();
        $file = $this->getCacheFile();
        if ((file_exists($file) && !is_writable($file)) || !is_writable(dirname($file))) {
            throw new \DomainException("Bad configuration for cache file [{$file}].");
        }
        if (!file_put_contents($file, serialize($this->data))) {
            throw new \DomainException("Could not save [components] to [{$file}].");
        }
        return $this;
    }

    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param Component $component
     * @return ComponentService
     */
    private function registerComponent(Component $component): ComponentService
    {
        $this->data['components'][$component->id] = $component;
        return $this;
    }

    /**
     * @return Component[]
     */
    public function getComponents(): array
    {
        return $this->data['components'];
    }

    /**
     * @return ComponentService
     * @throws \JsonException
     */
    private function buildComponents(): ComponentService
    {
        foreach ($this->data['components'] as $component) {
            foreach ($component->releases as $release) {
                $this->registerRelease($release);
            }
            foreach ($component->expressions as $expression) {
                $this->registerExpression($expression);
            }
        }
        return $this;
    }

    /**
     * @param Release $release
     * @return ComponentService
     * @throws \JsonException
     */
    private function registerRelease(Release $release): ComponentService
    {
        if ($release->isReleased()) {
            $this->data['releases'][] = $release;
            $file = new File($release->getDirectory(). '/manifest.json');
            if ($file->hasContents() && ($data = json_decode($file->getContents(), true, 512, JSON_THROW_ON_ERROR))) {
                $component = (new Component($this->appContext));
                $component->registerRelease($release);
                $component($data);
            }
        }
        return $this;
    }

    /**
     * @return Release[]
     */
    public function getReleases(): array
    {
        return $this->data['releases'];
    }

    /**
     * @return ComponentService
     */
    private function buildReleases(): ComponentService
    {
        usort(
            $this->data['releases'],
            static function ($r1, $r2) {
                if ($r1->date === $r2->date) {
                    return 0;
                }
                return ($r1->date > $r2->date) ? -1 : 1;
            }
        );
        return $this;
    }

    /**
     * @param Expression $expression
     * @return ComponentService
     */
    private function registerExpression(Expression $expression): ComponentService
    {
        if ($expression->isOwned()) {
            $this->data['expressions'][$expression->component->id][$expression->component->release->id] = $expression;
        }
        return $this;
    }

    /**
     * @return ComponentService
     */
    private function buildExpressions(): ComponentService
    {
        /** @var Component $component */
        foreach ($this->data['components'] as $component) {
            foreach ($component->expressions as $expression) {
                if (!$expression->isOwned()) {
                    $this->buildDependentExpression($expression);
                }
            }
            foreach ($component->releases as $release) {
                if ($release->isReleased()) {
                    foreach ($release->component->expressions as $expression) {
                        if (!$expression->title && !$expression->isOwned()) {
                            $this->buildDependentExpression($expression);
                        }
                    }
                }
            }
        }
        return $this;
    }

    private function buildDependentExpression(Expression $expression) : ComponentService
    {
        if ($expression->dependency) {
            $supplierComponent = clone $this->getComponent($expression->dependency->component);
            $supplierComponent->useRelease($expression->dependency->release);
            $supplierExpression = $supplierComponent->getExpressionById($expression->id);
            $expression->depends($supplierExpression);
        }
        return $this;
    }

    private function buildTypes(): ComponentService
    {
        /** @var Component $component */
        foreach ($this->data['components'] as $component) {
            $typeService = new TypeService($component->getAssetFilename('UML/class_index.adoc'));
            $typeService->build();
            $component->setTypes($typeService->types);
        }
        // special case of AOM1.4
        $component = $this->data['components']['AM'];
        $typeService = new TypeService($component->getAssetFilename('UML/AOM1.4/class_index.adoc'));
        $typeService->build();
        $component->setTypes($typeService->types);
        return $this;
    }

    /**
     * @param string $componentId
     * @return Component
     */
    public function getComponent(string $componentId): Component
    {
        if (!isset($this->data['components'][$componentId])) {
            throw new \DomainException('Invalid specification component: ' . $componentId);
        }
        /** @var Component $component */
        $component = $this->data['components'][$componentId];
        return $component;
    }

}
