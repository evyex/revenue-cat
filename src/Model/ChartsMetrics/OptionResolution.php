<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Model\ChartsMetrics;

use Evyex\RevenueCat\Model\ModelInterface;

readonly class OptionResolution implements ModelInterface
{
    private function __construct(
        private string $id,
        private string $displayName,
    ) {
    }

    public static function fromArray(array $data): static
    {
        return new self(
            id: $data['id'],
            displayName: $data['display_name'],
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
}
