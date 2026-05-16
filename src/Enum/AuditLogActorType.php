<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Enum;

enum AuditLogActorType: string
{
    case USER = 'user';
    case SYSTEM = 'system';
    case API_KEY = 'api_key';
    case OAUTH_CLIENT = 'oauth_client';
}
