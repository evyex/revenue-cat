<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Enum;

enum AppType: string
{
    case AMAZON = 'amazon';
    case APP_STORE = 'app_store';
    case MAC_APP_STORE = 'mac_app_store';
    case PLAY_STORE = 'play_store';
    case STRIPE = 'stripe';
    case RC_BILLING = 'rc_billing';
    case ROKU = 'roku';
    case PADDLE = 'paddle';
    case TEST_STORE = 'test_store';
}