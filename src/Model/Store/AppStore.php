<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Model\Store;

use Evyex\RevenueCat\Model\ModelInterface;

readonly class AppStore implements ModelInterface
{
    public function __construct(
        private string $bundleId,
        private bool $appStoreConnectApiKeyConfigured,
        private bool $subscriptionKeyConfigured,
    ) {
    }

    public static function fromArray(array $data): static
    {
        return new self(
            bundleId: $data['bundle_id'],
            appStoreConnectApiKeyConfigured: $data['app_store_connect_api_key_configured'],
            subscriptionKeyConfigured: $data['subscription_key_configured'],
        );
    }

    public function getBundleId(): string
    {
        return $this->bundleId;
    }

    public function isAppStoreConnectApiKeyConfigured(): bool
    {
        return $this->appStoreConnectApiKeyConfigured;
    }

    public function isSubscriptionKeyConfigured(): bool
    {
        return $this->subscriptionKeyConfigured;
    }
}
