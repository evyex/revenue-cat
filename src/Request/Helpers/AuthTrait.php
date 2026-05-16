<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Request\Helpers;

/**
 * @property string $token
 */
trait AuthTrait
{
    public function headers(): array
    {
        return ['Authorization' => 'Bearer ' . $this->token];
    }
}