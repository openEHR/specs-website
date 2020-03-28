<?php

namespace App\Domain\Data;

use App\Configuration;
use DateTime;

class Release extends AbstractModel implements \JsonSerializable
{
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

    public function setComponent(array $value = []): Release
    {
        $component = new Component($this->settings);
        $this->component = $component($value);
        return $this;
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
        $jira = new Jira($this->settings);
        $this->jira = $jira($value);
        return $this;
    }

    public function isReleased(): bool
    {
        return $this->id && ($this->date instanceof DateTime);
    }

    public function isLatest(): bool
    {
        return $this->id === 'latest';
    }

    public function makeLatest(): Release
    {
        $this->id = 'latest';
        return $this;
    }

    public function getLink(): string
    {
        if ($this->id && $this->component) {
            if ($this->isReleased()) {
                return "{$this->component->getLink()}/Release-{$this->id}";
            } elseif ($this->isLatest()) {
                return "{$this->component->getLink()}/latest";
            }
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
            'getLink()' => $this->getLink(),
        ];
    }
}
