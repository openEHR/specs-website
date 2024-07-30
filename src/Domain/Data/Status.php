<?php

namespace App\Domain\Data;

enum Status: string implements \JsonSerializable
{
    case STABLE = 'Stable';
    case TRIAL = 'Trial';
    case DEVELOPMENT = 'Development';
    case RETIRED = 'Retired';

    case UNKNOWN = 'Unknown';

    public function getBadge(): string
    {
        return match ($this) {
            Status::STABLE => 'success',
            Status::TRIAL => 'primary',
            Status::DEVELOPMENT => 'secondary',
            Status::RETIRED => 'danger',
            Status::UNKNOWN => 'light',
        };
    }

    public function getShort(): string
    {
        return substr($this->name, 0, 1);
    }

    public function isPartOfReleaseBaseline(): bool
    {
        return match ($this) {
            Status::STABLE, Status::TRIAL => true,
            default => false
        };
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'value' => $this->value,
            'badge' => $this->getBadge(),
            'short' => $this->getShort(),
            'releaseBaseline' => $this->isPartOfReleaseBaseline(),
        ];
    }
}
