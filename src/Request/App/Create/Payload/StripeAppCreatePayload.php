<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Request\App\Create\Payload;

use Evyex\RevenueCat\Enum\AppType;
use Evyex\RevenueCat\Request\Helpers\ParamTrait;

final readonly class StripeAppCreatePayload implements AppCreatePayloadInterface
{
    use ParamTrait;

    public function __construct(private ?string $stripeAccountId = null)
    {
    }

    public function appType(): AppType
    {
        return AppType::STRIPE;
    }

    public function toArray(): array
    {
        return $this->argToArray(['stripeAccountId']);
    }
}
