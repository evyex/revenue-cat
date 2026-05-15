<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Model;

final readonly class Subscription
{
    public function __construct(
        public string $id,
        public string $customerId,
        public ?string $productId,
        public int $startsAt,
        public ?int $currentPeriodEndsAt,
        public bool $givesAccess,
        public bool $pendingPayment,
        public string $autoRenewalStatus,
        public string $status,
        public string $environment,
        public string $store,
        public string $storeSubscriptionIdentifier,
        public ?string $managementUrl,
        public string $object = 'subscription',
    ) {
    }

    /** @param array<string,mixed> $data */
    public static function fromArray(array $data): self
    {
        return new self(
            (string) ($data['id'] ?? ''),
            (string) ($data['customer_id'] ?? ''),
            isset($data['product_id']) ? (string) $data['product_id'] : null,
            (int) ($data['starts_at'] ?? 0),
            isset($data['current_period_ends_at']) ? (int) $data['current_period_ends_at'] : null,
            (bool) ($data['gives_access'] ?? false),
            (bool) ($data['pending_payment'] ?? false),
            (string) ($data['auto_renewal_status'] ?? ''),
            (string) ($data['status'] ?? ''),
            (string) ($data['environment'] ?? ''),
            (string) ($data['store'] ?? ''),
            (string) ($data['store_subscription_identifier'] ?? ''),
            isset($data['management_url']) ? (string) $data['management_url'] : null,
            (string) ($data['object'] ?? 'subscription'),
        );
    }
}
