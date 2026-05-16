<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Request\App\Create\Payload;

use Evyex\RevenueCat\Enum\AppType;
use Evyex\RevenueCat\Request\Helpers\ParamTrait;

readonly class PlayStoreAppCreatePayload implements AppCreatePayloadInterface
{
    use ParamTrait;

    public function __construct(private string $packageName)
    {
    }

    public function appType(): AppType
    {
        return AppType::PLAY_STORE;
    }

    public function toArray(): array
    {
        return $this->argToArray(['packageName']);
    }
}
