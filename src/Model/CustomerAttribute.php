<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Model;

final readonly class CustomerAttribute
{
    public function __construct(
        public string $name,
        public ?string $value,
        public int $updatedAt,
        public string $object = 'customer.attribute',
    ) {
    }

    /** @param array<string,mixed> $data */
    public static function fromArray(array $data): self
    {
        return new self(
            (string) ($data['name'] ?? ''),
            isset($data['value']) ? (string) $data['value'] : null,
            (int) ($data['updated_at'] ?? 0),
            (string) ($data['object'] ?? 'customer.attribute'),
        );
    }

    /** @return array<string,mixed> */
    public function toArray(): array
    {
        return ['name' => $this->name, 'value' => $this->value];
    }
}
