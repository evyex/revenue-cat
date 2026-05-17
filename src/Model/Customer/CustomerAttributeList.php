<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Model\Customer;

use Evyex\RevenueCat\Model\AbstractPaginator;

class CustomerAttributeList extends AbstractPaginator
{
    protected function getItemClass(): string
    {
        return CustomerAttribute::class;
    }
}
