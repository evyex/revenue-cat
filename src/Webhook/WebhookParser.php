<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Webhook;

use Evyex\RevenueCat\Exception\RevenueCatException;

final class WebhookParser
{
    public function parse(string $payload): WebhookEvent
    {
        $decoded = json_decode($payload, true);
        if (!is_array($decoded)) {
            throw new RevenueCatException('Invalid webhook payload JSON');
        }

        $event = $decoded['event'] ?? $decoded;
        if (!is_array($event)) {
            throw new RevenueCatException('Invalid webhook event envelope');
        }

        return new WebhookEvent(
            type: (string) ($event['type'] ?? 'unknown'),
            apiVersion: isset($event['api_version']) ? (string) $event['api_version'] : null,
            eventTimestampMs: isset($event['event_timestamp_ms']) ? (int) $event['event_timestamp_ms'] : null,
            raw: $event,
        );
    }
}
