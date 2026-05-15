<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Http;

use Evyex\RevenueCat\Exception\ApiErrorException;
use Evyex\RevenueCat\Exception\RevenueCatException;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;

final readonly class ApiTransport
{
    public function __construct(
        private ClientInterface $httpClient,
        private RequestFactoryInterface $requestFactory,
        private string $baseUri,
        private ?string $authToken = null,
    ) {
    }

    public function withAuthToken(string $authToken): self
    {
        return new self($this->httpClient, $this->requestFactory, $this->baseUri, $authToken);
    }

    /** @return array<string,mixed> */
    public function request(string $method, string $path, array $query = [], ?array $body = null): array
    {
        $url = rtrim($this->baseUri, '/') . '/' . ltrim($path, '/');
        if ($query !== []) {
            $url .= '?' . http_build_query($query);
        }

        $request = $this->requestFactory->createRequest($method, $url)->withHeader('Accept', 'application/json');

        if ($this->authToken !== null && $this->authToken !== '') {
            $request = $request->withHeader('Authorization', 'Bearer ' . $this->authToken);
        }

        if ($body !== null) {
            $encoded = json_encode($body, JSON_THROW_ON_ERROR);
            $request->getBody()->write($encoded);
            $request = $request->withHeader('Content-Type', 'application/json');
        }

        try {
            $response = $this->httpClient->sendRequest($request);
        } catch (ClientExceptionInterface $e) {
            throw new RevenueCatException('HTTP transport error: ' . $e->getMessage(), previous: $e);
        } catch (JsonException $e) {
            throw new RevenueCatException('Failed to serialize request body: ' . $e->getMessage(), previous: $e);
        }

        $content = (string) $response->getBody();
        $decoded = $content === '' ? [] : json_decode($content, true);

        if (!is_array($decoded)) {
            throw new RevenueCatException('Unable to decode RevenueCat response body');
        }

        if ($response->getStatusCode() >= 400) {
            throw new ApiErrorException(
                $response->getStatusCode(),
                (string) ($decoded['type'] ?? 'unknown_error'),
                (string) ($decoded['message'] ?? 'Unknown API error'),
                (bool) ($decoded['retryable'] ?? false),
            );
        }

        return $decoded;
    }
}
