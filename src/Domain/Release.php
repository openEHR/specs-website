<?php


namespace App\Domain;

use App\Configuration;

class Release
{
    public $id;
    public $date;
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

    public function setId($value = null)
    {
        $this->id = $value;
        return $this;
    }

    public function setComponent($value = null)
    {
        $this->component = $value;
        return $this;
    }

    public function setDate($value = null)
    {
        try {
            $this->date = $value ? new \DateTime($value) : null;
        } catch (\Exception $e) {
        }
        return $this;
    }

    public function setJira(array $args = [])
    {
        $jira = new Jira($this->settings);
        $this->jira = $jira($args);
        return $this;
    }

    public function isReleased()
    {
        return $this->id && ($this->date instanceof \DateTime);
    }

    public function getLink()
    {
        if ($this->isReleased()) {
            return "/releases/{$this->component}/Release-{$this->id}";
        } else {
            return $this->jira->crs;
        }
    }

}