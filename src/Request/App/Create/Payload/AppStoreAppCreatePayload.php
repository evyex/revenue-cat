<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Request\App\Create\Payload;

use Evyex\RevenueCat\Enum\AppType;
use Evyex\RevenueCat\Request\Helpers\ParamTrait;

final readonly class AppStoreAppCreatePayload implements AppCreatePayloadInterface
{
    use ParamTrait;

    public function __construct(
        private string $bundleId,
        private ?string $sharedSecret = null,
        private ?string $subscriptionPrivateKey = null,
        private ?string $subscriptionKeyId = null,
        private ?string $subscriptionKeyIssuer = null,
        private ?string $appStoreConnectApiKey = null,
        private ?string $appStoreConnectApiKeyId = null,
        private ?string $appStoreConnectApiKeyIssuer = null,
        private ?string $appStoreConnectVendorNumber = null,
    ) {
    }

    public function appType(): AppType
    {
        return AppType::APP_STORE;
    }

    public function toArray(): array
    {
        return $this->argToArray([
            'bundleId',
            'sharedSecret',
            'subscriptionPrivateKey',
            'subscriptionKeyId',
            'subscriptionKeyIssuer',
            'appStoreConnectApiKey',
            'appStoreConnectApiKeyId',
            'appStoreConnectApiKeyIssuer',
            'appStoreConnectVendorNumber',
        ]);
    }
}
