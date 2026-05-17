<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Model\Customer;

use Evyex\RevenueCat\Model\AbstractPaginator;

class CustomerActiveEntitlementList extends AbstractPaginator
{
    protected function getItemClass(): string
    {
        return CustomerActiveEntitlement::class;
    }
}
