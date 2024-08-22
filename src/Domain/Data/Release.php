<?php
/** @noinspection PhpUnnecessaryCurlyVarSyntaxInspection */

namespace App\Domain\Data;

use DateTime;

class Release extends AbstractModel implements \JsonSerializable
{
    public const DEVELOPMENT = 'development';

    public const LATEST = 'latest';

    /** @var ?string */
    public ?string $id = null;
    /** @var ?DateTime */
    public ?DateTime $date = null;
    /** @var ?Jira */
    public ?Jira $jira = null;

    /** @var ?Component */
    public ?Component $component = null;

    public function setId($value): Release
    {
        $this->id = $value;
        return $this;
    }

    public function isDevelopment(): bool
    {
        return $this->id === self::DEVELOPMENT;
    }

    public function getId(): string
    {
        return $this->id === self::DEVELOPMENT ? self::DEVELOPMENT : "Release-{$this->id}";
    }

    public function is(string $id): bool
    {
        return strcasecmp($this->id, $id) === 0 || strcasecmp($this->getId(), $id) === 0;
    }

    public function setDate($value = null): Release
    {
        try {
            $this->date = $value ? new DateTime($value) : null;
        } catch (\Exception) {
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

    public function makeItDevelopment(): Release
    {
        $this->id = self::DEVELOPMENT;
        $this->jira = $this->component?->jira;
        return $this;
    }

    public function getLink(): string
    {
        if ($this->id && $this->component) {
            return "{$this->component->getLink()}/{$this->getId()}";
        }
        return '';
    }

    public function getLinkOfDevelopment(): string
    {
        return $this->component ? ($this->component->getLink() . '/' . self::DEVELOPMENT) : '';
    }

    public function getDirectory(): string
    {
        if ($this->id && $this->component) {
            return "{$this->component->getDirectory()}/{$this->getId()}";
        }
        return '';
    }

    /**
     * @return Specification[]
     */
    public function getSpecifications(): array
    {
        return $this->component->specifications ?? [];
    }

    /**
     * @return Expression[]
     */
    public function getExpressions(): array
    {
        return $this->component->expressions ?? [];
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'jira' => $this->jira,
            '_component' => $this->component->id,
            '_releaseInfo' => !$this->isReleased() ? null : [
                'released' => true,
                'specifications' => $this->getSpecifications(),
                'expressions' => $this->getExpressions(),
            ],
            '_getLink()' => $this->getLink(),
        ];
    }
}
