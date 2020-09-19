<?php

namespace App\Domain\Data;

class Note extends AbstractModel implements \JsonSerializable
{
    /** @var string */
    public $link;
    /** @var string */
    public $text;

    /** @var Specification */
    public $specification;

    public function setLink(string $value = null): Note
    {
        $this->link = $value;
        return $this;
    }

    public function setText(string $value = null): Note
    {
        $this->text = $value;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'link' => $this->link,
            'text' => $this->text,
            '_specification' => $this->specification->id,
        ];
    }
}
