<?php

namespace App\Domain\Data;

use App\Configuration;

class Specification extends AbstractModel implements \JsonSerializable
{
    /** @var string */
    public $id;
    /** @var string */
    public $title;
    /** @var string */
    public $title_short;
    /** @var string */
    public $description;
    /** @var string */
    public $keywords;
    /** @var string */
    public $link;
    /** @var Component */
    public $component;

    public function __invoke(array $args = [])
    {
        parent::__invoke($args);
        if (isset($args['title_short'])) {
            $this->setTitleShort($args['title_short'] ?? null);
        }
        return $this;
    }

    public function setId(string $value = null): Specification
    {
        $this->id = $value;
        return $this;
    }

    public function setTitle(string $value = null): Specification
    {
        $this->title = $value;
        return $this;
    }

    public function setTitleShort(string $value = null): Specification
    {
        $this->title_short = $value;
        return $this;
    }

    public function setDescription(string $value = null): Specification
    {
        $this->description = $value;
        return $this;
    }

    public function setKeywords(string $value = null): Specification
    {
        $this->keywords = $value;
        return $this;
    }

    public function setComponent(array $value = []): Specification
    {
        $component = new Component($this->settings);
        $this->component = $component($value);
        return $this;
    }

    public function setLink(string $value = null): Specification
    {
        $this->link = $value;
        return $this;
    }

    public function getLink(): string
    {
        if ($this->link) {
            return $this->link;
        } elseif ($this->id && $this->component && $this->component->release) {
            return "{$this->component->release->getLink()}/{$this->id}.html";
        }
        return '';
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'title_short' => $this->title_short,
            'description' => $this->description,
            'keywords' => $this->keywords,
            'getLink()' => $this->getLink(),
        ];
    }

}
