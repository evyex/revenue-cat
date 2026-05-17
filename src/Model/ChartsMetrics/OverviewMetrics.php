<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Model\ChartsMetrics;

use Evyex\RevenueCat\Model\ModelInterface;

class OverviewMetrics implements ModelInterface
{
    /**
     * @param array<int,array<string,mixed>> $metrics
     */
    private function __construct(
        private string $object,
        private array  $metrics,
    ) {
    }

    public static function fromArray(array $data): static
    {
        return new self($data['object'], $data['metrics']);
    }

    public function getObject(): string
    {
        return $this->object;
    }

    /**
     * @return \Generator<OverviewMetric>
     */
    public function getMetrics(): \Generator
    {
        foreach ($this->metrics as $metricData) {
            yield OverviewMetric::fromArray($metricData);
        }
    }
}
