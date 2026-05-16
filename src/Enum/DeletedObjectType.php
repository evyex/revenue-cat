<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Enum;

enum DeletedObjectType: string
{
    case APP = 'app';
    case CUSTOMER = 'customer';
    case DISCOUNT = 'discount';
    case ENTITLEMENT = 'entitlement';
    case EXPERIMENT = 'experiment';
    case OFFERING = 'offering';
    case PACKAGE = 'package';
    case PAYWALL = 'paywall';
    case PRODUCT = 'product';
    case VIRTUAL_CURRENCY = 'virtual_currency';
    case WEBHOOK_INTEGRATION = 'webhook_integration';
}
