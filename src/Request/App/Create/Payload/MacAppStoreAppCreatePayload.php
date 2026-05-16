<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Request\App\Create\Payload;

use Evyex\RevenueCat\Enum\AppType;
use Evyex\RevenueCat\Request\Helpers\ParamTrait;

final readonly class MacAppStoreAppCreatePayload implements AppCreatePayloadInterface
{
    use ParamTrait;

    public function __construct(
        private string $bundleId,
        private ?string $sharedSecret = null,
    ) {
    }

    public function appType(): AppType
    {
        return AppType::MAC_APP_STORE;
    }

    public function toArray(): array
    {
        return $this->argToArray(['bundleId', 'sharedSecret']);
    }
}
