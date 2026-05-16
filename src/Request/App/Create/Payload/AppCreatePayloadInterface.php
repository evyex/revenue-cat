<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Request\App\Create\Payload;

use Evyex\RevenueCat\Enum\AppType;

interface AppCreatePayloadInterface
{
    public function appType(): AppType;

    /** @return array<string,mixed> */
    public function toArray(): array;
}
