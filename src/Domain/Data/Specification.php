<?php

namespace App\Domain\Data;

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
    public $micro_summary;
    /** @var array */
    public $classes;
    /** @var string */
    public $keywords;
    /** @var Note[] */
    public $notes = array();
    /** @var string */
    public $link;

    /** @var Type[] */
    public $types = array();

    /** @var Type[] */
    public $summary_types = array();

    /** @var Component */
    public $component;

    public function __invoke(array $args = [])
    {
        parent::__invoke($args);
        if (isset($args['title_short'])) {
            $this->setTitleShort($args['title_short']);
        }
        if (isset($args['micro_summary'])) {
            $this->setMicroSummary($args['micro_summary']);
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

    public function setMicroSummary(string $value = null): Specification
    {
        $this->micro_summary = $value;
        return $this;
    }

    public function setClasses(array $value = []): Specification
    {
        $this->classes = $value;
        return $this;
    }

    public function setKeywords(string $value = null): Specification
    {
        $this->keywords = $value;
        return $this;
    }

    public function setNotes(array $value = []): Specification
    {
        foreach ($value as $i => $data) {
            $note = (new Note())($data);
            $note->specification = $this;
            $this->notes[$i] = $note;
        }
        return $this;
    }

    public function setLink(string $value = null): Specification
    {
        $this->link = $value;
        return $this;
    }

    public function registerType(Type $type): Specification
    {
        $this->types[$type->name] = $type;
        $type->specification = $this;
        if ($this->classes) {
            foreach ($this->classes as $class) {
                if ($type->is($class)) {
                    $this->summary_types[$class] = $type;
                    break;
                }
            }
        }
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
            'micro_summary' => $this->micro_summary,
            'classes' => $this->classes,
            'keywords' => $this->keywords,
            'notes' => $this->notes,
            'types' => $this->types,
            'summary_types' => $this->summary_types,
            '_component' => $this->component->id,
            '_getLink()' => $this->getLink(),
        ];
    }

}
