<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Model;

use Evyex\RevenueCat\Response;

interface ModelInterface
{
    public static function fromArray(array $data): self;
}