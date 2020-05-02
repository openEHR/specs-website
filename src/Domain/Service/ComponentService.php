<?php

namespace App\Domain\Service;

use App\Configuration;
use App\Domain\Data\Release;
use App\Domain\Data\Component;

class ComponentService
{
    /** @var Configuration */
    protected $settings;
    /** @var array */
    protected $data;

    public function __construct(Configuration $settings)
    {
        $this->settings = $settings;
        $file = $this->getCacheFile();
        if (!is_readable($file) || !($data = file_get_contents($file)) || !($this->data = unserialize($data))) {
            $this->build();
        }
    }

    private function getCacheFile(): string
    {
        $file = "{$this->settings->temp}/ComponentService.sdata";
        return $file;
    }

    public function build(): ComponentService
    {
        $this->data = [
            'components' => [],
            'releases' => [],
            'expressions' => [],
        ];
        $releasesRoot = "{$this->settings->sites_root}/releases";
        if (!is_readable($releasesRoot) || !is_dir($releasesRoot)) {
            throw new \DomainException("Bad configuration for [sites_root={$this->settings->sites_root}].");
        }
        foreach (glob("{$releasesRoot}/*/latest/manifest.json") as $file) {
            if (is_readable($file) && ($content = file_get_contents($file)) && ($data = json_decode($content, true))) {
                $component = (new Component($this->settings))($data);
                $this->registerComponent($component);
                foreach ($component->expressions as $i => $expression) {
                    if ($expression->isOwned()) {
                        $this->data['expressions'][$expression->id] = $expression;
                    }
                }
            }
        }
        $this->buildComponents();
        $this->buildReleases();
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
     * @return $this
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
     */
    private function buildComponents(): ComponentService
    {
        foreach ($this->data['components'] as $component) {
            foreach ($component->releases as $release) {
                $this->registerRelease($release);
            }
        }
        return $this;
    }

    /**
     * @param Release $release
     * @return ComponentService
     */
    private function registerRelease(Release $release): ComponentService
    {
        if ($release->isReleased()) {
            $this->data['releases'][] = $release;
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
            function ($r1, $r2) {
                if ($r1->date === $r2->date) {
                    return 0;
                }
                return ($r1->date > $r2->date) ? -1 : 1;
            }
        );
        return $this;
    }

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
