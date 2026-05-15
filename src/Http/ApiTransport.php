<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Http;

use Evyex\RevenueCat\Exception\ApiErrorException;
use Evyex\RevenueCat\Exception\RevenueCatException;
use InvalidArgumentException;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;

final readonly class ApiTransport
{
    private const API_HOST = 'https://api.revenuecat.com';

    private readonly ?string $authToken;

    public function __construct(
        private ClientInterface $httpClient,
        private RequestFactoryInterface $requestFactory,
        ?string $authToken = null,
    ) {
        $this->authToken = self::normalizeAuthToken($authToken);
    }

    public function withAuthToken(string $authToken): self
    {
        return new self($this->httpClient, $this->requestFactory, $authToken);
    }

    /** @return array<string,mixed> */
    public function request(string $method, string $path, array $query = [], ?array $body = null): array
    {
        $url = rtrim(self::API_HOST, '/') . '/' . ltrim($path, '/');
        if ($query !== []) {
            $url .= '?' . http_build_query($query);
        }

        $request = $this->requestFactory->createRequest($method, $url)->withHeader('Accept', 'application/json');

        if ($this->authToken !== null) {
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

    private static function normalizeAuthToken(?string $authToken): ?string
    {
        if ($authToken === null) {
            return null;
        }

        $trimmed = trim($authToken);
        if ($trimmed === '') {
            throw new InvalidArgumentException('RevenueCat auth token must not be blank.');
        }

        return $trimmed;
    }
}
