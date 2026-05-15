<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Model;

final readonly class CustomerActiveEntitlement
{
    public function __construct(
        public string $entitlementId,
        public ?int $expiresAt,
        public string $object = 'customer.active_entitlement',
    ) {
    }

    /** @param array<string,mixed> $data */
    public static function fromArray(array $data): self
    {
        return new self(
            (string) ($data['entitlement_id'] ?? ''),
            isset($data['expires_at']) ? (int) $data['expires_at'] : null,
            (string) ($data['object'] ?? 'customer.active_entitlement'),
        );
    }
}
