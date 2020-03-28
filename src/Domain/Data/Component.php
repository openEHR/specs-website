<?php

namespace App\Domain\Data;

use App\Configuration;

class Component extends AbstractModel
{
    /** @var string */
    public $id;
    /** @var string */
    public $title;
    /** @var string */
    public $description;
    /** @var string */
    public $keywords;
    /** @var Jira */
    public $jira;
    /** @var Specification[] */
    public $specifications;
    /** @var Expression[] */
    public $expressions;
    /** @var Release[] */
    public $releases;
    /** @var Release */
    public $release;

    public function setId(string $value = null): Component
    {
        $this->id = $value;
        return $this;
    }

    public function setTitle(string $value = null): Component
    {
        $this->title = $value;
        return $this;
    }

    public function setDescription(string $value = null): Component
    {
        $this->description = $value;
        return $this;
    }

    public function setKeywords(string $value = null): Component
    {
        $this->keywords = $value;
        return $this;
    }

    public function setJira(array $value = []): Component
    {
        $jira = new Jira($this->settings);
        $this->jira = $jira($value);
        return $this;
    }

    public function setSpecifications(array $value = []): Component
    {
        foreach ($value as $i => $data) {
            $specification = (new Specification($this->settings))($data);
            $specification->component = $this;
            $this->specifications[$i] = $specification;
        }
        return $this;
    }

    public function setExpressions(array $value = []): Component
    {
        foreach ($value as $i => $data) {
            $expression = (new Expression($this->settings))($data);
            $expression->component = $this;
            $this->expressions[$i] = $expression;
        }
        return $this;
    }

    public function setReleases(array $value = []): Component
    {
        foreach ($value as $i => $data) {
            $release = (new Release($this->settings))($data);
            $release->component = $this;
            $this->releases[$i] = $release;
        }
        return $this;
    }

    public function setRelease(string $releaseId): Component
    {
        foreach ($this->releases as $release) {
            if ($release->id === $releaseId) {
                $this->release = $release;
                return $this;
            }
        }
        $this->setLatestRelease();
        return $this;
    }
    
    public function setLatestRelease() {
        $this->release = new Release($this->settings);
        $this->release->makeLatest();
        $this->release->component = $this;
        $this->release->jira = $this->jira;
        return $this;
    }

    public function getLink(): string
    {
        if ($this->id) {
            return "/releases/{$this->id}";
        }
        return '';
    }
}
