<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Enum\ChartsMetrics;

enum ChartName: string
{
    case ACTIVES = 'actives';
    case ACTIVES_MOVEMENT = 'actives_movement';
    case ACTIVES_NEW = 'actives_new';
    case ARR = 'arr';
    case CHURN = 'churn';
    case COHORT_EXPLORER = 'cohort_explorer';
    case CONVERSION_TO_PAYING = 'conversion_to_paying';
    case CUSTOMERS_NEW = 'customers_new';
    case LTV_PER_CUSTOMER = 'ltv_per_customer';
    case LTV_PER_PAYING_CUSTOMER = 'ltv_per_paying_customer';
    case MRR = 'mrr';
    case MRR_MOVEMENT = 'mrr_movement';
    case REFUND_RATE = 'refund_rate';
    case REVENUE = 'revenue';
    case SUBSCRIPTION_RETENTION = 'subscription_retention';
    case SUBSCRIPTION_STATUS = 'subscription_status';
    case TRIALS = 'trials';
    case TRIALS_MOVEMENT = 'trials_movement';
    case TRIALS_NEW = 'trials_new';
    case CUSTOMERS_ACTIVE = 'customers_active';
    case TRIAL_CONVERSION_RATE = 'trial_conversion_rate';
}
