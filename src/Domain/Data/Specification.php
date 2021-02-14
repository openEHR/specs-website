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
    public $spec_status;
    /** @var string */
    public $copyright_year;
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

    public const STATUSES = array(
        'STABLE' => ['badge' => 'success', 'short' => 'S', 'title' => 'STABLE'],
        'TRIAL' => ['badge' => 'primary', 'short' => 'T', 'title' => 'TRIAL'],
        'DEV' => ['badge' => 'secondary', 'short' => 'D', 'title' => 'DEV'],
        'DEVELOPMENT' => ['badge' => 'secondary', 'short' => 'D', 'title' => 'DEV'],
        'RETIRED' => ['badge' => 'danger', 'short' => 'R', 'title' => 'RETIRED'],
        'SUPERSEDED' => ['badge' => 'danger', 'short' => 'E', 'title' => 'SUPERSEDED'],
        'OBSOLETE' => ['badge' => 'danger', 'short' => 'O', 'title' => 'OBSOLETE'],
        'ARCHIVED' => ['badge' => 'danger', 'short' => 'A', 'title' => 'ARCHIVED'],
        '_' => ['badge' => 'light', 'short' => 'N', 'title' => 'UNKNOWN'],
    );

    public function __invoke(array $args = [])
    {
        parent::__invoke($args);
        if (isset($args['title_short'])) {
            $this->setTitleShort($args['title_short']);
        }
        if (isset($args['micro_summary'])) {
            $this->setMicroSummary($args['micro_summary']);
        }
        if (isset($args['spec_status'])) {
            $this->setSpecStatus($args['spec_status']);
        }
        if (isset($args['copyright_year'])) {
            $this->setCopyrightYear($args['copyright_year']);
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

    public function setSpecStatus(string $value = null): Specification
    {
        $this->spec_status = $value && isset(self::STATUSES[$value]) ? $value : '_';
        return $this;
    }

    public function setCopyrightYear(string $value = null): Specification
    {
        $this->copyright_year = $value;
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

    public function hasExplicitLink(): bool
    {
        return (bool)$this->link;
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

    public function getStatusBadge(): string
    {
        return self::STATUSES[$this->spec_status]['badge'];
    }

    public function getStatusShort(): string
    {
        return self::STATUSES[$this->spec_status]['short'];
    }

    public function getStatusTitle(): string
    {
        return self::STATUSES[$this->spec_status]['title'];
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
            'spec_status' => $this->spec_status,
            'copyright_year' => $this->copyright_year,
            'keywords' => $this->keywords,
            'notes' => $this->notes,
            'types' => $this->types,
            'summary_types' => $this->summary_types,
            '_component' => $this->component->id,
            '_status' => [
                'badge' => $this->getStatusBadge(),
                'short' => $this->getStatusShort(),
                'title' => $this->getStatusTitle(),
            ],
            '_getLink()' => $this->getLink(),
        ];
    }

}
