<?php

declare(strict_types=1);

namespace Evyex\RevenueCat;

class Normalizer
{
    public static function dateTime(int $timestamp): \DateTimeImmutable
    {
        return new \DateTimeImmutable('@' . (int) ($timestamp/1000));
    }

    public static function path(string $template, ...$args): string
    {
        return sprintf($template, ...array_map('urlencode', $args));
    }
}