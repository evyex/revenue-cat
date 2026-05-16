<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Request\App\Create\Payload;

use Evyex\RevenueCat\Enum\AppType;
use Evyex\RevenueCat\Request\Helpers\ParamTrait;

readonly class PaddleAppCreatePayload implements AppCreatePayloadInterface
{
    use ParamTrait;

    public function __construct(private ?string $paddleApiKey = null)
    {
    }

    public function appType(): AppType
    {
        return AppType::PADDLE;
    }

    public function toArray(): array
    {
        return $this->argToArray(['paddleApiKey']);
    }
}
