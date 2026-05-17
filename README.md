# revenue-cat

MVP SDK for RevenueCat REST API(backend/server side), built on PSR interfaces.

## Notes for contributors

- Response payloads can be enriched with transport metadata (for example HTTP headers/status code) by design.
- Treat this as an intentional contract, not an accidental side effect.

## Requirements

- PHP 8.2+
- `psr/http-client`
- `psr/http-factory`
- `psr/http-message`

## Example: List apps (v2)

```php
<?php

use Evyex\RevenueCat\Request\App\ListAppsRequest;
use Evyex\RevenueCat\RevenueCatClient;

$client = new RevenueCatClient($httpClient, $requestFactory, $streamFactory);

$response = $client->send(new ListAppsRequest(
    token: 'rc_xxx_secret_v2_key',
    projectId: 'proj1ab2c3d4',
    limit: 20,
));

$apps = $response->getData();
```

## Example: Create app (v2)

```php
<?php

use Evyex\RevenueCat\Model\Enum\RcBillingCurrency;
use Evyex\RevenueCat\Request\App\Create\Payload\RcBillingAppCreatePayload;
use Evyex\RevenueCat\Request\App\CreateAppRequest;
use Evyex\RevenueCat\RevenueCatClient;

$client = new RevenueCatClient($httpClient, $requestFactory, $streamFactory);

$response = $client->send(new CreateAppRequest(
    token: 'rc_xxx_secret_v2_key',
    projectId: 'proj1ab2c3d4',
    name: 'My RevenueCat App',
    payload: new RcBillingAppCreatePayload(
        appName: 'My RevenueCat App',
        defaultCurrency: RcBillingCurrency::USD,
        supportEmail: 'support@example.com',
    ),
));

$app = $response->getData();
```

## Example: Get StoreKit config (v2)

```php
<?php

use Evyex\RevenueCat\Request\App\GetAppStoreKitConfigRequest;
use Evyex\RevenueCat\RevenueCatClient;

$client = new RevenueCatClient($httpClient, $requestFactory, $streamFactory);

$response = $client->send(new GetAppStoreKitConfigRequest(
    token: 'rc_xxx_secret_v2_key',
    projectId: 'proj1ab2c3d4',
    appId: 'app1a2b3c4',
));

$storeKitConfig = $response->getData();
```

## Example: List audit logs (v2)

```php
<?php

use Evyex\RevenueCat\Request\AuditLog\ListAuditLogsRequest;
use Evyex\RevenueCat\RevenueCatClient;

$client = new RevenueCatClient($httpClient, $requestFactory, $streamFactory);

$response = $client->send(new ListAuditLogsRequest(
    token: 'rc_xxx_secret_v2_key',
    projectId: 'proj1ab2c3d4',
    startDate: new \DateTimeImmutable('2024-01-01'),
    endDate: new \DateTimeImmutable('2024-12-31'),
    limit: 20,
));

$auditLogs = $response->getData();
```

## Example: Delete app (v2)

```php
<?php

use Evyex\RevenueCat\Request\App\DeleteAppRequest;
use Evyex\RevenueCat\RevenueCatClient;

$client = new RevenueCatClient($httpClient, $requestFactory, $streamFactory);

$response = $client->send(new DeleteAppRequest(
    token: 'rc_xxx_secret_v2_key',
    projectId: 'proj1ab2c3d4',
    appId: 'app1a2b3c4',
));

$deleted = $response->getData();
```

## Example: Update app (v2)

```php
<?php

use Evyex\RevenueCat\Request\App\Create\Payload\PlayStoreAppCreatePayload;
use Evyex\RevenueCat\Request\App\UpdateAppRequest;
use Evyex\RevenueCat\RevenueCatClient;

$client = new RevenueCatClient($httpClient, $requestFactory, $streamFactory);

$response = $client->send(new UpdateAppRequest(
    token: 'rc_xxx_secret_v2_key',
    projectId: 'proj1ab2c3d4',
    appId: 'app1a2b3c4',
    name: 'Updated app name',
    payload: new PlayStoreAppCreatePayload(packageName: 'com.example.updated'),
));

$app = $response->getData();
```

## Example: Get app (v2)

```php
<?php

use Evyex\RevenueCat\Request\App\GetAppRequest;
use Evyex\RevenueCat\RevenueCatClient;

$client = new RevenueCatClient($httpClient, $requestFactory, $streamFactory);

$response = $client->send(new GetAppRequest(
    token: 'rc_xxx_secret_v2_key',
    projectId: 'proj1ab2c3d4',
    appId: 'app1a2b3c4',
));

$app = $response->getData();
```

## Example: Get overview metrics (v2)

```php
<?php

use Evyex\RevenueCat\Enum\Currency;
use Evyex\RevenueCat\Request\ChartsMetrics\GetOverviewMetricsRequest;
use Evyex\RevenueCat\RevenueCatClient;

$client = new RevenueCatClient($httpClient, $requestFactory, $streamFactory);

$response = $client->send(new GetOverviewMetricsRequest(
    token: 'rc_xxx_secret_v2_key',
    projectId: 'proj1ab2c3d4',
    currency: Currency::EUR,
));

$overviewMetrics = $response->getData();
```

## Example: Get chart data (v2)

```php
<?php

use Evyex\RevenueCat\Enum\ChartsMetrics\ChartAggregate;
use Evyex\RevenueCat\Enum\ChartsMetrics\ChartName;
use Evyex\RevenueCat\Enum\ChartsMetrics\ChartResolution;
use Evyex\RevenueCat\Enum\Currency;
use Evyex\RevenueCat\Request\ChartsMetrics\GetChartDataRequest;
use Evyex\RevenueCat\Request\Filter;
use Evyex\RevenueCat\RevenueCatClient;

$client = new RevenueCatClient($httpClient, $requestFactory, $streamFactory);

$response = $client->send(new GetChartDataRequest(
    token: 'rc_xxx_secret_v2_key',
    projectId: 'proj1ab2c3d4',
    chartName: ChartName::REVENUE,
    currency: Currency::USD,
    startDate: new \DateTimeImmutable('2024-01-01'),
    endDate: new \DateTimeImmutable('2024-12-31'),
    resolution: ChartResolution::DAY,
    aggregate: [ChartAggregate::TOTAL, ChartAggregate::AVERAGE],
    filters: [new Filter('country', ['US', 'UK'])],
));

$chartData = $response->getData();
```

## Example: Get chart options (v2)

```php
<?php

use Evyex\RevenueCat\Enum\ChartsMetrics\ChartName;
use Evyex\RevenueCat\Request\ChartsMetrics\GetChartOptionsRequest;
use Evyex\RevenueCat\RevenueCatClient;

$client = new RevenueCatClient($httpClient, $requestFactory, $streamFactory);

$response = $client->send(new GetChartOptionsRequest(
    token: 'rc_xxx_secret_v2_key',
    projectId: 'proj1ab2c3d4',
    chartName: ChartName::REVENUE,
));

$chartOptions = $response->getData();
```

## Example: List collaborators (v2)

```php
<?php

use Evyex\RevenueCat\Request\Collaborator\ListCollaboratorsRequest;
use Evyex\RevenueCat\RevenueCatClient;

$client = new RevenueCatClient($httpClient, $requestFactory, $streamFactory);

$response = $client->send(new ListCollaboratorsRequest(
    token: 'rc_xxx_secret_v2_key',
    projectId: 'proj1ab2c3d4',
    limit: 20,
));

$collaborators = $response->getData();
```
