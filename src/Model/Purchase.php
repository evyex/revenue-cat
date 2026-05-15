<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Model;

final readonly class Purchase
{
    public function __construct(
        public string $id,
        public string $customerId,
        public string $productId,
        public int $purchasedAt,
        public string $status,
        public string $environment,
        public string $store,
        public string $storePurchaseIdentifier,
        public string $object = 'purchase',
    ) {
    }

    /** @param array<string,mixed> $data */
    public static function fromArray(array $data): self
    {
        return new self(
            (string) ($data['id'] ?? ''),
            (string) ($data['customer_id'] ?? ''),
            (string) ($data['product_id'] ?? ''),
            (int) ($data['purchased_at'] ?? 0),
            (string) ($data['status'] ?? ''),
            (string) ($data['environment'] ?? ''),
            (string) ($data['store'] ?? ''),
            (string) ($data['store_purchase_identifier'] ?? ''),
            (string) ($data['object'] ?? 'purchase'),
        );
    }
}
