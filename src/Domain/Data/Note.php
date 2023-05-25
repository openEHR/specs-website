<?php

namespace App\Domain\Data;

class Note extends AbstractModel implements \JsonSerializable
{
    /** @var ?string */
    public ?string $link = null;
    /** @var ?string */
    public ?string $text = null;

    /** @var ?Specification */
    public ?Specification $specification = null;

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
    public function jsonSerialize(): array
    {
        return [
            'link' => $this->link,
            'text' => $this->text,
            '_specification' => $this->specification->id,
        ];
    }
}
