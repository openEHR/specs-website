<?php


namespace App\Domain;

use App\Configuration;
use DateTime;

class Release
{
    /** @var string */
    public $id;
    /** @var DateTime */
    public $date;
    /** @var Jira */
    public $jira;

    public $component;

    protected $settings;

    public function __construct(Configuration $settings)
    {
        $this->settings = $settings;
    }

    public function __invoke(array $args = [])
    {
        if (!empty($args['id'])) {
            $this->setId($args['id']);
            $this->setComponent($args['component'] ?? null);
            $this->setDate($args['date'] ?? null);
            $this->setJira($args['jira'] ?? []);
        }
        return $this;
    }

    public function setId($value): Release
    {
        $this->id = $value;
        return $this;
    }

    public function setComponent($value = null): Release
    {
        $this->component = $value;
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

    public function getLink(): string
    {
        if ($this->isReleased()) {
            return "/releases/{$this->component}/Release-{$this->id}";
        } else {
            return $this->jira->crs;
        }
    }

}