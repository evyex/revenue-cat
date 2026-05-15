<?php

declare(strict_types=1);

namespace Evyex\RevenueCat;

use InvalidArgumentException;

final readonly class Config
{
    public function __construct(
        public string $apiKey,
        public string $projectId,
    ) {
        if (trim($this->apiKey) === '') {
            throw new InvalidArgumentException('Config apiKey must not be blank.');
        }
        if (trim($this->projectId) === '') {
            throw new InvalidArgumentException('Config projectId must not be blank.');
        }
    }
}
