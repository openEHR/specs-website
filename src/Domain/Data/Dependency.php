<?php

namespace App\Domain\Data;

class Dependency extends AbstractModel implements \JsonSerializable
{
    /** @var string */
    public $component;
    /** @var string */
    public $release;

    /** @var Expression */
    public $expression;

    public function setComponent(string $value = null): Dependency
    {
        $this->component = $value;
        return $this;
    }

    public function setRelease(string $value = null): Dependency
    {
        $this->release = $value;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'component' => $this->component,
            'release' => $this->release,
            '_expression' => $this->expression->id,
        ];
    }

}
