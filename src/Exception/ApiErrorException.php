<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Exception;

final class ApiErrorException extends RevenueCatException
{
    public function __construct(
        public readonly int $statusCode,
        public readonly string $type,
        public readonly string $errorMessage,
        public readonly bool $retryable,
    ) {
        parent::__construct(sprintf('RevenueCat API error (%d, %s): %s', $statusCode, $type, $errorMessage));
    }
}
