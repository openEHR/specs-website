<?php


namespace App\Domain;


use App\Configuration;

class Component
{
    public $id;
    public $title;
    public $description;
    public $keywords;
    /** @var Jira */
    public $jira;
    public $specifications;
    public $expressions;
    /** @var Release[] */
    public $releases;
    /** @var Release */
    public $release;

    protected $settings;

    public function __construct(Configuration $settings)
    {
        $this->settings = $settings;
    }

    public function __invoke(array $args = [])
    {
        if (!empty($args['id'])) {
            $this->setId($args['id']);
            $this->setTitle($args['title'] ?? null);
            $this->setDescription($args['description'] ?? null);
            $this->setKeywords($args['keywords'] ?? null);
            $this->setJira($args['jira'] ?? []);
            $this->setSpecifications($args['specifications'] ?? []);
            $this->setExpressions($args['expressions'] ?? []);
            $this->setReleases($args['releases'] ?? []);
        }
        return $this;
    }

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
        $this->specifications = $value;
        return $this;
    }

    public function setExpressions(array $value = []): Component
    {
        $this->expressions = $value;
        return $this;
    }

    public function setReleases(array $value = []): Component
    {
        foreach ($value as $i => $releaseData) {
            $release = (new Release($this->settings))($releaseData);
            $release->setComponent($this->id);
            $this->releases[$i] = $release;
        }
        return $this;
    }

    public function setRelease($releaseId = 'latest'): Component
    {
        foreach ($this->releases as $release) {
            if ($release->id === $releaseId) {
                $this->release = $release;
                return $this;
            }
        }
        $this->release = (new Release($this->settings))(
            [
                'id' => $releaseId,
                'component' => $this->id
            ]
        );
        $this->release->jira = $this->jira;
        return $this;
    }
}