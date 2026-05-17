<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Request\ChartsMetrics;

use Evyex\RevenueCat\Enum\ChartsMetrics\ChartName;
use Evyex\RevenueCat\Model\ChartsMetrics\ChartOptions;
use Evyex\RevenueCat\Normalizer;
use Evyex\RevenueCat\Request\Helpers\AuthTrait;
use Evyex\RevenueCat\Request\Helpers\GetTrait;
use Evyex\RevenueCat\Request\Helpers\ParamTrait;
use Evyex\RevenueCat\Request\RevenueCatRequestInterface;

class GetChartOptionsRequest implements RevenueCatRequestInterface
{
    use AuthTrait;
    use GetTrait;
    use ParamTrait;

    public function __construct(
        #[\SensitiveParameter]
        private string $token,
        private string $projectId,
        private ChartName $chartName,
        private ?bool $realtime = null,
    ) {
    }

    public function path(): string
    {
        return Normalizer::path('/v2/projects/%s/charts/%s/options', $this->projectId, $this->chartName->value);
    }

    public function query(): array
    {
        return $this->argToArray(['realtime']);
    }

    public static function dataClass(): string
    {
        return ChartOptions::class;
    }
}
