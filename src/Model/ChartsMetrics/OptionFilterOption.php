<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Model\ChartsMetrics;

use Evyex\RevenueCat\Model\ModelInterface;

class OptionFilterOption implements ModelInterface
{
    private function __construct(
        private string $id,
        private string $displayName,
        private array $properties,
    )
    {
    }

    public static function fromArray(array $data): ModelInterface
    {
        return new self(
            $data['id'],
            $data['displayName'],
            $data['properties'] ?? [],
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

    public function getProperty(string $name): mixed
    {
        return $this->properties[$name] ?? null;
    }
}