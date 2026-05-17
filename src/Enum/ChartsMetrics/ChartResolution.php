<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Enum\ChartsMetrics;

enum ChartResolution: string
{
    case DAY = 'day';
    case WEEK = 'week';
    case MONTH = 'month';
    case QUARTER = 'quarter';
    case YEAR = 'year';
}
