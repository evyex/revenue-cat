<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Request;

use Evyex\RevenueCat\Model\ModelInterface;

/**
 * @template TResponse of ModelInterface
 */
interface RevenueCatRequestInterface
{
    public function method(): string;

    public function path(): string;

    /** @return array<string,scalar> */
    public function query(): array;

    /** @return array<string,string> */
    public function headers(): array;

    /** @return array<string,mixed>|null */
    public function jsonBody(): ?array;

    /**
     * @return class-string<TResponse>
     */
    public static function dataClass(): string;
}
