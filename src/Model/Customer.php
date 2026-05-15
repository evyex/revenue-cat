<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Model;

final readonly class Customer
{
    /**
     * @param list<CustomerActiveEntitlement> $activeEntitlements
     * @param list<CustomerAttribute> $attributes
     */
    public function __construct(
        public string $id,
        public string $projectId,
        public int $firstSeenAt,
        public ?int $lastSeenAt,
        public ?string $lastSeenAppVersion,
        public ?string $lastSeenCountry,
        public ?string $lastSeenPlatform,
        public ?string $lastSeenPlatformVersion,
        public array $activeEntitlements,
        public array $attributes,
        public string $object = 'customer',
    ) {
    }

    /** @param array<string,mixed> $data */
    public static function fromArray(array $data): self
    {
        $entitlements = [];
        $attributes = [];

        $rawEntitlements = $data['active_entitlements']['items'] ?? [];
        if (is_array($rawEntitlements)) {
            foreach ($rawEntitlements as $item) {
                if (is_array($item)) {
                    $entitlements[] = CustomerActiveEntitlement::fromArray($item);
                }
            }
        }

        $rawAttributes = $data['attributes']['items'] ?? [];
        if (is_array($rawAttributes)) {
            foreach ($rawAttributes as $item) {
                if (is_array($item)) {
                    $attributes[] = CustomerAttribute::fromArray($item);
                }
            }
        }

        return new self(
            (string) ($data['id'] ?? ''),
            (string) ($data['project_id'] ?? ''),
            (int) ($data['first_seen_at'] ?? 0),
            isset($data['last_seen_at']) ? (int) $data['last_seen_at'] : null,
            isset($data['last_seen_app_version']) ? (string) $data['last_seen_app_version'] : null,
            isset($data['last_seen_country']) ? (string) $data['last_seen_country'] : null,
            isset($data['last_seen_platform']) ? (string) $data['last_seen_platform'] : null,
            isset($data['last_seen_platform_version']) ? (string) $data['last_seen_platform_version'] : null,
            $entitlements,
            $attributes,
            (string) ($data['object'] ?? 'customer'),
        );
    }
}
