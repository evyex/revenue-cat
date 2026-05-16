<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Enum;

enum Environment: string
{
    case PRODUCTION = 'production';
    case SANDBOX = 'sandbox';
}
