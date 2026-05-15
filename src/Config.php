<?php

declare(strict_types=1);

namespace Evyex\RevenueCat;

final readonly class Config
{
    public function __construct(
        public string $apiKey,
        public string $projectId,
        public string $baseUri = 'https://api.revenuecat.com/v2',
    ) {
    }
}
