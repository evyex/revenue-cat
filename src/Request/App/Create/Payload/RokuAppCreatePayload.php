<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Request\App\Create\Payload;

use Evyex\RevenueCat\Enum\AppType;
use Evyex\RevenueCat\Request\Helpers\ParamTrait;

readonly class RokuAppCreatePayload implements AppCreatePayloadInterface
{
    use ParamTrait;

    public function __construct(
        private ?string $rokuApiKey = null,
        private ?string $rokuChannelId = null,
        private ?string $rokuChannelName = null,
    ) {
    }

    public function appType(): AppType
    {
        return AppType::ROKU;
    }

    public function toArray(): array
    {
        return $this->argToArray(['rokuApiKey', 'rokuChannelId', 'rokuChannelName']);
    }
}
