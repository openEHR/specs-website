<?php

namespace App\Domain\Data;

class Dependency extends AbstractModel implements \JsonSerializable
{
    /** @var ?string */
    public ?string $component = null;
    /** @var ?string */
    public ?string $release = null;

    /** @var ?Expression */
    public ?Expression $expression = null;

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
    public function jsonSerialize(): array
    {
        return [
            'component' => $this->component,
            'release' => $this->release,
            '_expression' => $this->expression->id,
        ];
    }

}
