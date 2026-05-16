<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Model\Store;

use Evyex\RevenueCat\Model\ModelInterface;

readonly class Paddle implements ModelInterface
{
    public function __construct(
        private bool $paddleIsSandbox,
        private ?string $paddleApiKey,
    ) {
    }

    public static function fromArray(array $data): static
    {
        return new self(
            paddleIsSandbox: $data['paddle_is_sandbox'],
            paddleApiKey: $data['paddle_api_key'] ?? null,
        );
    }

    public function isPaddleSandbox(): bool
    {
        return $this->paddleIsSandbox;
    }

    public function getPaddleApiKey(): ?string
    {
        return $this->paddleApiKey;
    }
}
