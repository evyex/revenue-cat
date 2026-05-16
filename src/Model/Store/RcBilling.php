<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Model\Store;

use Evyex\RevenueCat\Enum\Currency;
use Evyex\RevenueCat\Model\ModelInterface;

readonly class RcBilling implements ModelInterface
{
    public function __construct(
        private ?string $stripeAccountId,
        private string $appName,
        private ?string $supportEmail,
        private Currency $defaultCurrency,
    ) {
    }

    public static function fromArray(array $data): static
    {
        return new self(
            stripeAccountId: $data['stripe_account_id'] ?? null,
            appName: $data['app_name'],
            supportEmail: $data['support_email'] ?? null,
            defaultCurrency: Currency::from($data['default_currency']),
        );
    }

    public function getStripeAccountId(): ?string
    {
        return $this->stripeAccountId;
    }

    public function getAppName(): string
    {
        return $this->appName;
    }

    public function getSupportEmail(): ?string
    {
        return $this->supportEmail;
    }

    public function getDefaultCurrency(): Currency
    {
        return $this->defaultCurrency;
    }
}
