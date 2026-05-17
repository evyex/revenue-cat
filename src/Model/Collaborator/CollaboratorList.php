<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Model\Collaborator;

use Evyex\RevenueCat\Model\AbstractPaginator;

class CollaboratorList extends AbstractPaginator
{
    protected function getItemClass(): string
    {
        return Collaborator::class;
    }
}
