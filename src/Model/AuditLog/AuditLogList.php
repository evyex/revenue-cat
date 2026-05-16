<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Model\AuditLog;

use Evyex\RevenueCat\Model\AbstractPaginator;

class AuditLogList extends AbstractPaginator
{
    protected function getItemClass(): string
    {
        return AuditLog::class;
    }
}
