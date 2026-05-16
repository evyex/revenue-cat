<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Request\Helpers;

trait GetTrait
{
    public function method(): string
    {
        return 'GET';
    }

    public function jsonBody(): ?array
    {
        return null;
    }
}