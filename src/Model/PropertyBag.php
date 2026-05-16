<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Model;

readonly class PropertyBag
{
    /**
     * @param array<string,mixed> $properties
     */
    private function __construct(private array $properties)
    {
    }

    /**
     * @param array<string,mixed> $data
     */
    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    public function getProperty(string $propertyName): mixed
    {
        return $this->properties[$propertyName] ?? null;
    }

    /**
     * @return array<string,mixed>
     */
    public function all(): array
    {
        return $this->properties;
    }
}
