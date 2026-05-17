<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Model\Customer;

use Evyex\RevenueCat\Model\ModelInterface;
use Evyex\RevenueCat\Normalizer;

readonly class CustomerActiveEntitlement implements ModelInterface
{
    private function __construct(
        private string $object,
        private string $entitlementId,
        private ?\DateTimeImmutable $expiresAt,
    ) {
    }

    public static function fromArray(array $data): static
    {
        return new self(
            object: $data['object'],
            entitlementId: $data['entitlement_id'],
            expiresAt: isset($data['expires_at']) ? Normalizer::dateTime($data['expires_at']) : null,
        );
    }

    public function getObject(): string
    {
        return $this->object;
    }

    public function getEntitlementId(): string
    {
        return $this->entitlementId;
    }

    public function getExpiresAt(): ?\DateTimeImmutable
    {
        return $this->expiresAt;
    }
}
