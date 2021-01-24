<?php

namespace App\Domain\Data;

use App\Configuration;
use App\Helper\ITSAsset;

class Component extends AbstractModel
{
    /** @var string */
    public $id;
    /** @var string */
    public $title;
    /** @var string */
    public $description;
    /** @var string */
    public $keywords;
    /** @var Jira */
    public $jira;
    /** @var Specification[] */
    public $specifications = array();
    /** @var Expression[] */
    public $expressions = array();
    /** @var Release[] */
    public $releases = array();
    /** @var Release */
    public $release;
    /** @var Type[] */
    public $types = array();
    /** @var Package[] */
    public $packages = array();

    protected $settings;

    public function __construct(Configuration $settings)
    {
        $this->settings = $settings;
    }

    public function __invoke(array $args = [])
    {
        parent::__invoke($args);
        if (!$this->release) {
            $this->registerRelease(new Release());
            $this->release->makeLatest();
        }
        return $this;
    }

    public function setId(string $value = null): Component
    {
        $this->id = $value;
        return $this;
    }

    public function is(string $id): bool
    {
        return strcasecmp($this->id, $id) === 0;
    }

    public function setTitle(string $value = null): Component
    {
        $this->title = $value;
        return $this;
    }

    public function setDescription(string $value = null): Component
    {
        $this->description = $value;
        return $this;
    }

    public function setKeywords(string $value = null): Component
    {
        $this->keywords = $value;
        return $this;
    }

    public function setJira(array $value = []): Component
    {
        $this->jira = (new Jira())($value);
        $this->jira->component = $this;
        return $this;
    }

    public function setSpecifications(array $value = []): Component
    {
        foreach ($value as $i => $data) {
            $specification = (new Specification())($data);
            $specification->component = $this;
            $this->specifications[$i] = $specification;
        }
        return $this;
    }

    public function getSpecificationById(string $id = ''): Specification
    {
        foreach ($this->specifications as $specification) {
            if ($specification->is($id)) {
                return $specification;
            }
        }
        throw new \DomainException("Invalid specification: $id.");
    }

    public function setExpressions(array $value = []): Component
    {
        foreach ($value as $i => $data) {
            $expression = (new Expression())($data);
            $expression->component = $this;
            $this->expressions[$i] = $expression;
        }
        return $this;
    }

    public function getExpressionById(string $id): Expression
    {
        foreach ($this->expressions as $expression) {
            if ($expression->is($id)) {
                return $expression;
            }
        }
        throw new \DomainException("Invalid expression: $id.");
    }

    public function setReleases(array $value = []): Component
    {
        foreach ($value as $i => $data) {
            $release = (new Release())($data);
            $release->component = $this;
            $this->releases[$i] = $release;
        }
        return $this;
    }

    public function getReleaseById(string $id): Release
    {
        if ($id === Release::STABLE) {
            foreach ($this->releases as $release) {
                if ($release->isReleased()) {
                    return $release;
                }
            }
            $id = Release::LATEST;
        }
        if ($this->release && $this->release->is($id)) {
            return $this->release;
        }
        foreach ($this->releases as $release) {
            if ($release->is($id)) {
                return $release;
            }
        }
        throw new \DomainException("Invalid release: $id.");
    }

    public function useRelease(string $releaseId): Component
    {
        $this->release = $this->getReleaseById($releaseId ?: Release::STABLE);
        return $this;
    }

    public function registerRelease(Release $release): Component
    {
        $this->release = $release;
        $this->release->component = $this;
        return $this;
    }

    public function registerPackage(Package $package): Component
    {
        $this->packages[$package->name] = $package;
        return $this;
    }

    public function getPackageByName(string $packageName): Package
    {
        if (isset($this->packages[$packageName])) {
            return $this->packages[$packageName];
        }
        foreach ($this->packages as $package) {
            if ($package->is($packageName)) {
                return $package;
            }
        }
        throw new \DomainException("Invalid package: $packageName.");
    }

    public function registerType(Type $type): Component
    {
        $this->types[$type->name] = $type;
        try {
            $specification = $this->getSpecificationById($type->specificationId);
            $specification->registerType($type);
            try {
                $package = $this->getPackageByName($type->packageName);
                $package->registerType($type);
            } catch (\Exception $e) {
                $package = (new Package())(['name' => $type->packageName]);
                $this->registerPackage($package);
                $package->registerType($type);
            }
            $type->component = $this;
        } catch (\Exception $e) {
            // silently do nothing
        }
        return $this;
    }

    public function setTypes(array $types): Component
    {
        foreach ($types as $data) {
            $type = (new Type())($data);
            $this->registerType($type);
        }
        return $this;
    }

    public function getTypeByName(string $typeName): Type
    {
        if (isset($this->types[$typeName])) {
            return $this->types[$typeName];
        }
        foreach ($this->types as $type) {
            if ($type->is($typeName)) {
                return $type;
            }
        }
        throw new \DomainException("Invalid type: $typeName.");
    }

    public function getLink(): string
    {
        if ($this->id) {
            return "/releases/{$this->id}";
        }
        return '';
    }

    public function getDirectory(): string
    {
        if ($this->id) {
            return "{$this->settings->sites_root}/releases/{$this->id}";
        }
        return '';
    }

    public function getFilename(string $filename = ''): string
    {
        if ($filename && $this->id && $this->release) {
            $filename = preg_replace('/\.{2,}/', '.', $filename);
            return "{$this->release->getDirectory()}/{$filename}";
        }
        return '';
    }

    public function getAssetFilename(string $asset = ''): string
    {
        if ($asset) {
            $asset = preg_replace('/^docs\//', '', $asset);
            return $this->getFilename("docs/{$asset}");
        }
        return '';
    }

    public function getScriptsAssetFilename(string $asset = ''): string
    {
        if ($asset) {
            $asset = preg_replace('/^scripts\//', '', $asset);
            return $this->getFilename("scripts/{$asset}");
        }
        return '';
    }

    public function getUMLFilename(string $asset = ''): string
    {
        if ($asset) {
            return $this->getFilename("computable/UML/{$asset}");
        }
        return '';
    }

    public function getITSAsset(string $asset = ''): ITSAsset
    {
        $filename = $this->getFilename("components/{$asset}");
        $itsAsset = new ITSAsset($filename);
        $itsAsset->setComponent($this);
        return $itsAsset;
    }

}
