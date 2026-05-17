<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Model\Customer;

use Evyex\RevenueCat\Model\AbstractPaginator;

class CustomerList extends AbstractPaginator
{
    protected function getItemClass(): string
    {
        return CustomerBase::class;
    }
}
