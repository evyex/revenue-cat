<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Model\Store;

use Evyex\RevenueCat\Model\ModelInterface;

final readonly class Roku implements ModelInterface
{
    public function __construct(
        private ?string $rokuChannelId,
        private ?string $rokuChannelName,
    ) {
    }

    public static function fromArray(array $data): static
    {
        return new self(
            rokuChannelId: $data['roku_channel_id'] ?? null,
            rokuChannelName: $data['roku_channel_name'] ?? null,
        );
    }

    public function getRokuChannelId(): ?string
    {
        return $this->rokuChannelId;
    }

    public function getRokuChannelName(): ?string
    {
        return $this->rokuChannelName;
    }
}
