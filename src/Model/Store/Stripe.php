<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Model\Store;

use Evyex\RevenueCat\Model\ModelInterface;

final readonly class Stripe implements ModelInterface
{
    public function __construct(private ?string $stripeAccountId)
    {
    }

    public static function fromArray(array $data): static
    {
        return new self(stripeAccountId: $data['stripe_account_id'] ?? null);
    }

    public function getStripeAccountId(): ?string
    {
        return $this->stripeAccountId;
    }
}
