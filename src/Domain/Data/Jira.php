<?php


namespace App\Domain\Data;


use App\Configuration;

class Jira extends AbstractModel implements \JsonSerializable
{
    /** @var string */
    public $open_issues;
    /** @var string */
    public $roadmap;
    /** @var string */
    public $crs;
    /** @var string */
    public $prs;

    /** @var Component */
    public $component;

    /** @var Release */
    public $release;

    public function __invoke(array $args = []): Jira
    {
        parent::__invoke($args);
        if (isset($args['open_issues'])) {
            $this->setOpenIssues($args['open_issues']);
        }
        return $this;
    }

    public function setCrs(string $value): Jira
    {
        $this->crs = $value;
        return $this;
    }

    public function setOpenIssues(string $value): Jira
    {
        $this->open_issues = $value;
        return $this;
    }

    public function setPrs(string $value): Jira
    {
        $this->prs = $value;
        return $this;
    }

    public function setRoadmap(string $value): Jira
    {
        $this->roadmap = $value;
        return $this;
    }

    public function getOpenIssues(): string
    {
        return $this->component ? "{$this->component->getLink()}/open_issues" : '';
    }

    public function getCrs(): string
    {
        return $this->component ? "{$this->component->getLink()}/crs" : '';
    }

    public function getHistory(): string
    {
        $component = $this->component ?? ($this->release ? $this->release->component : null);
        return $component ? "{$component->getLink()}/history" : '';
    }

    public function getRoadmap(): string
    {
        $component = $this->component ?? ($this->release ? $this->release->component : null);
        return $component ? "{$component->getLink()}/roadmap" : '';
    }

    public function getIssues(): string
    {
        return $this->release ? "{$this->release->getLink()}/issues" : '';
    }

    public function getChanges(): string
    {
        return $this->release ? "{$this->release->getLink()}/changes" : '';
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'crs' => $this->crs,
            'prs' => $this->prs,
            'open_issues' => $this->open_issues,
            'roadmap' => $this->roadmap,
            '_component' => $this->component ? $this->component->id : null,
            '_release' => $this->release ? $this->release->id : null,
        ];
    }
}
