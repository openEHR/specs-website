<?php


namespace App\Domain;


use App\Configuration;

class Jira extends AbstractModel
{
    /** @var string */
    public $crs;
    /** @var string */
    public $prs;

    public function __invoke(array $args = []): Jira
    {
        if (!empty($args['crs'])) {
            $this->setCrs($args['crs']);
        } elseif (!empty($args['open_issues'])) {
            $this->setOpenIssues($args['open_issues']);
        }
        if (!empty($args['prs'])) {
            $this->setPrs($args['prs']);
        } elseif (!empty($args['roadmap'])) {
            $this->setRoadmap($args['roadmap']);
        }
        return $this;
    }

    public function setCrs(string $value): Jira
    {
        $this->crs = sprintf($this->settings->jira_projects, $value);
        return $this;
    }

    public function setOpenIssues(string $value): Jira
    {
        $this->crs = sprintf($this->settings->jira_filter, $value);
        return $this;
    }

    public function setPrs(string $value): Jira
    {
        $this->prs = sprintf($this->settings->jira_projects, $value);
        return $this;
    }

    public function setRoadmap(string $value): Jira
    {
        $this->prs = sprintf($this->settings->jira_roadmap, $value);
        return $this;
    }
}
