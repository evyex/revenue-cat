<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Request;

class ParamObject implements \JsonSerializable
{
    public function __construct(
        private array $params = []
    )
    {
    }

    public function jsonSerialize(): mixed
    {
        return $this->params;
    }
}