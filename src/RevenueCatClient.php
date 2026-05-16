<?php

declare(strict_types=1);

namespace Evyex\RevenueCat;

use Evyex\RevenueCat\Model\ModelInterface;
use Evyex\RevenueCat\Request\RevenueCatRequestInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

class RevenueCatClient
{
    private const API_HOST = 'https://api.revenuecat.com/';

    public function __construct(
        private ClientInterface $httpClient,
        private RequestFactoryInterface $requestFactory,
        private StreamFactoryInterface $streamFactory,
    ) {
    }

    /**
     * @template TResponse of ModelInterface
     * @param RevenueCatRequestInterface<TResponse> $request
     * @return Response<TResponse>
     * @throws \Exception
     */
    public function send(RevenueCatRequestInterface $request): Response
    {
        $url = self::API_HOST . ltrim($request->path(), '/');
        $query = $request->query();
        if ($query !== []) {
            $url .= '?' . http_build_query($query);
        }

        $psrRequest = $this->requestFactory->createRequest($request->method(), $url);
        foreach ($request->headers() as $name => $value) {
            $psrRequest = $psrRequest->withHeader($name, $value);
        }

        $jsonBody = $request->jsonBody();
        if ($jsonBody !== null) {
            $psrRequest = $psrRequest
                ->withHeader('Content-Type', 'application/json')
                ->withBody($this->streamFactory->createStream((string) json_encode($jsonBody, JSON_THROW_ON_ERROR)));
        }

        try {
            $response = $this->httpClient->sendRequest($psrRequest);
        } catch (ClientExceptionInterface $e) {
            throw new \RuntimeException('RevenueCat transport error', previous: $e);
        }

        return new Response($response, $request::dataClass());
    }
}
