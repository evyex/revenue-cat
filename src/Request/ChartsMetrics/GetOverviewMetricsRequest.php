<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Request\ChartsMetrics;

use Evyex\RevenueCat\Enum\Currency;
use Evyex\RevenueCat\Model\ChartsMetrics\OverviewMetrics;
use Evyex\RevenueCat\Normalizer;
use Evyex\RevenueCat\Request\Helpers\AuthTrait;
use Evyex\RevenueCat\Request\Helpers\GetTrait;
use Evyex\RevenueCat\Request\Helpers\ParamTrait;
use Evyex\RevenueCat\Request\RevenueCatRequestInterface;

class GetOverviewMetricsRequest implements RevenueCatRequestInterface
{
    use AuthTrait;
    use GetTrait;
    use ParamTrait;

    public function __construct(
        #[\SensitiveParameter]
        private string $token,
        private string $projectId,
        private ?Currency $currency = null,
    ) {
    }

    public function path(): string
    {
        return Normalizer::path('/v2/projects/%s/metrics/overview', $this->projectId);
    }

    public function query(): array
    {
        return $this->argToArray(['currency']);
    }

    public static function dataClass(): string
    {
        return OverviewMetrics::class;
    }
}
