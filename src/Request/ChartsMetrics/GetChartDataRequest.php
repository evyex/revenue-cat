<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Request\ChartsMetrics;

use Evyex\RevenueCat\Enum\ChartsMetrics\ChartName;
use Evyex\RevenueCat\Enum\ChartsMetrics\ChartResolution;
use Evyex\RevenueCat\Enum\Currency;
use Evyex\RevenueCat\Model\ChartsMetrics\ChartData;
use Evyex\RevenueCat\Normalizer;
use Evyex\RevenueCat\Request\Helpers\AuthTrait;
use Evyex\RevenueCat\Request\Helpers\GetTrait;
use Evyex\RevenueCat\Request\Helpers\ParamTrait;
use Evyex\RevenueCat\Request\Filter;
use Evyex\RevenueCat\Request\ParamObject;
use Evyex\RevenueCat\Request\RevenueCatRequestInterface;
use Evyex\RevenueCat\Enum\ChartsMetrics\ChartAggregate;

class GetChartDataRequest implements RevenueCatRequestInterface
{
    use AuthTrait;
    use GetTrait;
    use ParamTrait;

    private ?string $startDate;
    private ?string $endDate;

    public function __construct(
        #[\SensitiveParameter]
        private string $token,
        private string $projectId,
        private ChartName $chartName,
        private ?bool $realtime = null,
        /** @var Filter[]|null */
        private ?array $filters = null,
        private ?ParamObject $selectors = null,
        private ?Currency $currency = null,
        ?\DateTimeInterface $startDate = null,
        ?\DateTimeInterface $endDate = null,
        private ?string $resolution = null,
        private ?string $segment = null,
        private ?int $limitNumSegments = null,
        /** @var ChartAggregate[]|null */
        private ?array $aggregate = null,
    ) {
        $this->startDate = $startDate?->format('Y-m-d');
        $this->endDate = $endDate?->format('Y-m-d');
    }

    public function path(): string
    {
        return Normalizer::path('/v2/projects/%s/charts/%s', $this->projectId, $this->chartName->value);
    }

    public function query(): array
    {
        $query = array_merge(
            $this->argToArray([
            'currency',
            'startDate',
            'endDate',
            'resolution',
            'segment',
            'limitNumSegments',
            'realtime',
             ]),
            $this->serializeProperties(['filters', 'selectors'])
        );

        if ($this->aggregate !== null) {
            $query['aggregate'] = implode(
                ',',
                array_map(static fn (ChartAggregate $aggregate): string => $aggregate->value, $this->aggregate)
            );
        }

        return $query;
    }

    public static function dataClass(): string
    {
        return ChartData::class;
    }
}
