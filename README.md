# revenue-cat

MVP SDK for RevenueCat REST API v2 (backend/server side), built on PSR interfaces.

## Requirements

- PHP 8.2+
- `psr/http-client`
- `psr/http-factory`
- `psr/http-message`

## Quick start

```php
<?php

use Evyex\RevenueCat\Config;
use Evyex\RevenueCat\Model\CustomerAttribute;
use Evyex\RevenueCat\Request\CreateCustomerRequest;
use Evyex\RevenueCat\Request\ListRequest;
use Evyex\RevenueCat\RevenueCat;

$config = new Config(
    apiKey: 'rc_xxx_secret_key',
    projectId: 'proj1ab2c3d4',
);

$client = RevenueCat::client($psr18Client, $psr17RequestFactory, $config);

$customer = $client->createCustomer(
    new CreateCustomerRequest(
        id: 'user-123',
        attributes: [new CustomerAttribute('$email', 'cat@example.com', updatedAt: 0)],
    )
);

$subscriptions = $client->listSubscriptions(
    customerId: 'user-123',
    request: new ListRequest(environment: 'production', limit: 20),
);

foreach ($subscriptions->items as $subscription) {
    // $subscription is Evyex\RevenueCat\Model\Subscription
}
```

## Supported MVP endpoints

- `createCustomer`
- `getCustomer`
- `listSubscriptions`
- `listPurchases`
- `listActiveEntitlements`

## Webhook starter

```php
<?php

use Evyex\RevenueCat\Webhook\WebhookParser;

$event = (new WebhookParser())->parse($rawJsonPayload);
// $event->type
// $event->raw
```
