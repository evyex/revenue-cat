<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Webhook;

final readonly class WebhookEvent
{
    /** @param array<string,mixed> $raw */
    public function __construct(
        public string $type,
        public ?string $apiVersion,
        public ?int $eventTimestampMs,
        public array $raw,
    ) {
    }
}
