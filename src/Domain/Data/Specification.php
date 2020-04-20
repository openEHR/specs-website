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
    public $summary;
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

    public function getBasename(): string
    {
        return "{$this->id}.html";
    }

    public function is(string $id): bool
    {
        return strcasecmp($this->id, $id) === 0 || strcasecmp($this->getBasename(), $id) === 0;
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

    public function setSummary(string $value = null): Specification
    {
        $this->summary = $value;
        return $this;
    }

    public function setKeywords(string $value = null): Specification
    {
        $this->keywords = $value;
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
            return "{$this->component->release->getLink()}/{$this->getBasename()}";
        }
        return '';
    }

    public function getDirectory(): string
    {
        if ($this->id && $this->component && $this->component->release) {
            return "{$this->component->release->getDirectory()}/docs/{$this->id}";
        }
        return '';
    }

    public function getFilename(): string
    {
        if ($this->id && $this->component && $this->component->release) {
            return "{$this->component->release->getDirectory()}/docs/{$this->getBasename()}";
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
            'summary' => $this->summary,
            'keywords' => $this->keywords,
            '_component' => $this->component->id,
            '_getLink()' => $this->getLink(),
        ];
    }

}
