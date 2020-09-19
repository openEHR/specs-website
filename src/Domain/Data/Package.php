<?php

namespace App\Domain\Data;

class Package extends AbstractModel implements \JsonSerializable
{
    /** @var string */
    public $name;

    /** @var Type[] */
    public $types;

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): Package
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
     * @param Type $type
     * @return $this
     */
    public function registerType(Type $type): Package
    {
        $this->types[$type->name] = $type;
        $type->package = $this;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'name' => $this->name,
            '_count(types)' => count($this->types)
        ];
    }

}
