<?php

namespace App\Domain\Data;

class Jira extends AbstractModel implements \JsonSerializable
{
    /** @var ?string */
    public ?string $open_issues = null;
    /** @var ?string */
    public ?string $roadmap = null;
    /** @var ?string */
    public ?string $crs = null;
    /** @var ?string */
    public ?string $prs = null;

    /** @var ?Component */
    public ?Component $component = null;

    /** @var ?Release */
    public ?Release $release = null;

    public function __invoke(array $args = []): static
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
        $component = $this->component ?? ($this->release->component ?? null);
        return $component ? "{$component->getLink()}/history" : '';
    }

    public function getRoadmap(): string
    {
        $component = $this->component ?? ($this->release?->component);
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
    public function jsonSerialize(): array
    {
        return [
            'crs' => $this->crs,
            'prs' => $this->prs,
            'open_issues' => $this->open_issues,
            'roadmap' => $this->roadmap,
            '_component' => $this->component->id ?? null,
            '_release' => $this->release->id ?? null,
        ];
    }
}
