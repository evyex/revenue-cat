<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Request;

readonly class Filter implements \JsonSerializable
{
    /**
     * @param list<string|int|float|bool> $values
     */
    public function __construct(
        private string $name,
        private array $values,
    ) {
    }

    public function jsonSerialize(): mixed
    {
        return [
            'name' => $this->name,
            'values' => $this->values,
        ];
    }
}
