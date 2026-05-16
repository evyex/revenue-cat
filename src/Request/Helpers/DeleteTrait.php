<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Request\Helpers;

trait DeleteTrait
{
    public function method(): string
    {
        return 'DELETE';
    }

    public function query(): array
    {
        return [];
    }

    public function jsonBody(): ?array
    {
        return null;
    }
}
