<?php

declare(strict_types=1);

namespace Evyex\RevenueCat;

use Evyex\RevenueCat\Http\ApiTransport;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;

final class RevenueCat
{
    public static function client(
        ClientInterface $httpClient,
        RequestFactoryInterface $requestFactory,
        Config $config,
    ): RevenueCatClient {
        return RevenueCatClient::build(new ApiTransport($httpClient, $requestFactory, $config->baseUri), $config);
    }
}
