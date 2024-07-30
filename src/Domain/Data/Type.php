<?php
/** @noinspection PhpUnnecessaryCurlyVarSyntaxInspection */

namespace App\Domain\Data;

class Type extends AbstractModel implements \JsonSerializable
{

    /** @var string */
    public string $name;

    /** @var string */
    public string $fragment;

    /** @var string */
    public string $packageName;

    /** @var string */
    public string $releaseId;

    /** @var string */
    public string $specificationId;

    /** @var ?Package */
    public ?Package $package = null;

    /** @var ?Specification */
    public ?Specification $specification = null;

    /** @var ?Component */
    public ?Component $component = null;

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): Type
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function is(string $name): bool
    {
        return strcasecmp($this->name, $name) === 0;
    }

    /**
     * @param string $fragment
     * @return $this
     */
    public function setFragment(string $fragment): Type
    {
        $this->fragment = $fragment;
        return $this;
    }

    /**
     * @param string $packageName
     * @return $this
     */
    public function setPackageName(string $packageName): Type
    {
        $this->packageName = $packageName;
        return $this;
    }

    /**
     * @param string $releaseId
     * @return $this
     */
    public function setReleaseId(string $releaseId): Type
    {
        $this->releaseId = $releaseId;
        return $this;
    }

    /**
     * @param string $specificationId
     * @return $this
     */
    public function setSpecificationId(string $specificationId): Type
    {
        $this->specificationId = $specificationId;
        return $this;
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        if ($this->specification) {
            return "{$this->specification->getLink()}#{$this->fragment}";
        }
        return '';
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'fragment' => $this->fragment,
            'package' => is_object($this->package) ? $this->package->name : null,
            'specification' => is_object($this->specification) ? $this->specification->id : null,
            '_getLink()' => $this->getLink(),
        ];
    }

}
