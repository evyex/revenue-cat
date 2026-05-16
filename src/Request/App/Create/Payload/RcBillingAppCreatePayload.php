<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Request\App\Create\Payload;

use Evyex\RevenueCat\Enum\AppType;
use Evyex\RevenueCat\Enum\Currency;
use Evyex\RevenueCat\Request\Helpers\ParamTrait;

readonly class RcBillingAppCreatePayload implements AppCreatePayloadInterface
{
    use ParamTrait;

    public function __construct(
        private string $appName,
        private ?Currency $defaultCurrency = null,
        private ?string $supportEmail = null,
        private ?string $stripeAccountId = null,
    ) {
    }

    public function appType(): AppType
    {
        return AppType::RC_BILLING;
    }

    public function toArray(): array
    {
        return $this->argToArray(['appName', 'defaultCurrency', 'supportEmail', 'stripeAccountId']);
    }
}
