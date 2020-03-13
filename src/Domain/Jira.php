<?php


namespace App\Domain;


use App\Configuration;

class Jira
{

    public $crs;
    public $prs;

    protected $settings;

    public function __construct(Configuration $settings)
    {
        $this->settings = $settings;
    }

    public function __invoke(array $args = [])
    {
        $this->setCrs($args['crs'] ?? null);
        $this->setPrs($args['prs'] ?? null);
        return $this;
    }

    public function setCrs($value = null)
    {
        $this->crs = "{$this->settings->jira_projects}/{$value}";
        return $this;
    }

    public function setPrs($value = null)
    {
        $this->prs = "{$this->settings->jira_projects}/{$value}";
        return $this;
    }
}