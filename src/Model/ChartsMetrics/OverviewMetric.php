<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Model\ChartsMetrics;

use Evyex\RevenueCat\Model\ModelInterface;
use Evyex\RevenueCat\Normalizer;

readonly class OverviewMetric implements ModelInterface
{
    private function __construct(
        private string $object,
        private string $id,
        private string $name,
        private string $description,
        private string $unit,
        private string $period,
        private int|float $value,
        private \DateTimeImmutable $lastUpdatedAt,
        private string $lastUpdatedAtIso8601,
    ) {
    }

    public static function fromArray(array $data): static
    {
        return new self(
            object: $data['object'],
            id: $data['id'],
            name: $data['name'],
            description: $data['description'],
            unit: $data['unit'],
            period: $data['period'],
            value: $data['value'],
            lastUpdatedAt: Normalizer::dateTime($data['last_updated_at']),
            lastUpdatedAtIso8601: $data['last_updated_at_iso8601'],
        );
    }

    public function getObject(): string { return $this->object; }
    public function getId(): string { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getDescription(): string { return $this->description; }
    public function getUnit(): string { return $this->unit; }
    public function getPeriod(): string { return $this->period; }
    public function getValue(): int|float { return $this->value; }
    public function getLastUpdatedAt(): \DateTimeImmutable { return $this->lastUpdatedAt; }
    public function getLastUpdatedAtIso8601(): string { return $this->lastUpdatedAtIso8601; }
}
