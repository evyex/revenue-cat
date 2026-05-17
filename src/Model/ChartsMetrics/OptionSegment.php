<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Model\ChartsMetrics;

use Evyex\RevenueCat\Model\ModelInterface;

class OptionSegment implements ModelInterface
{
    public function __construct(
        private string $id,
        private string $displayName,
        private ?string $groupDisplayName,
    )
    {
    }

    public static function fromArray(array $data): ModelInterface
    {
        return new self(
            id: $data['id'],
            displayName: $data['display_name'],
            groupDisplayName: $data['group_display_name'] ?? null,
        );
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getDisplayName(): string
    {
        return $this->displayName;
    }

    public function getGroupDisplayName(): ?string
    {
        return $this->groupDisplayName;
    }
}