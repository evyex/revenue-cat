<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Request\App\Create\Payload;

use Evyex\RevenueCat\Enum\AppType;
use Evyex\RevenueCat\Request\Helpers\ParamTrait;

final readonly class AmazonAppCreatePayload implements AppCreatePayloadInterface
{
    use ParamTrait;

    public function __construct(
        private string $packageName,
        private ?string $sharedSecret = null,
    ) {
    }

    public function appType(): AppType
    {
        return AppType::AMAZON;
    }

    public function toArray(): array
    {
        return $this->argToArray(['packageName', 'sharedSecret']);
    }
}
