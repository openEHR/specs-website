<?php

namespace App\Domain\Data;

use DateTime;

class Release extends AbstractModel implements \JsonSerializable
{
    public const LATEST = 'latest';

    /** @var string */
    public $id;
    /** @var DateTime */
    public $date;
    /** @var Jira */
    public $jira;

    /** @var Component */
    public $component;

    public function setId($value): Release
    {
        $this->id = $value;
        return $this;
    }

    public function isLatest(): bool
    {
        return $this->id === self::LATEST;
    }

    public function getId(): string
    {
        return $this->id === self::LATEST ? self::LATEST : "Release-{$this->id}";
    }

    public function is(string $id): bool
    {
        return strcasecmp($this->id, $id) === 0 || strcasecmp($this->getId(), $id) === 0;
    }

    public function setDate($value = null): Release
    {
        try {
            $this->date = $value ? new DateTime($value) : null;
        } catch (\Exception $e) {
        }
        return $this;
    }

    public function setJira(array $value = []): Release
    {
        $this->jira = (new Jira())($value);
        $this->jira->release = $this;
        return $this;
    }

    public function isReleased(): bool
    {
        return $this->id && ($this->date instanceof DateTime);
    }

    public function makeLatest(): Release
    {
        $this->id = self::LATEST;
        $this->jira = $this->component->jira;
        return $this;
    }

    public function getLink(): string
    {
        if ($this->id && $this->component) {
            return "{$this->component->getLink()}/{$this->getId()}";
        }
        return '';
    }

    public function getDirectory(): string
    {
        if ($this->id && $this->component) {
            return "{$this->component->getDirectory()}/{$this->getId()}";
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
            'date' => $this->date,
            'jira' => $this->jira,
            '_component' => $this->component->id,
            '_getLink()' => $this->getLink(),
        ];
    }
}
