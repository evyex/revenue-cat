<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Model\App;

use Evyex\RevenueCat\Model\AbstractPaginator;

final class AppList extends AbstractPaginator
{
    protected function getItemClass(): string
    {
        return App::class;
    }
}
