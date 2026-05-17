<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Model\Customer;

use Evyex\RevenueCat\Model\ModelInterface;
use Evyex\RevenueCat\Normalizer;

readonly class CustomerAttribute implements ModelInterface
{
    private function __construct(
        private string $object,
        private string $name,
        private ?string $value,
        private \DateTimeImmutable $updatedAt,
    ) {
    }

    public static function fromArray(array $data): static
    {
        return new self(
            object: $data['object'],
            name: $data['name'],
            value: $data['value'] ?? null,
            updatedAt: Normalizer::dateTime($data['updated_at']),
        );
    }

    public function getObject(): string
    {
        return $this->object;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }
}
