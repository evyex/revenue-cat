<?php

declare(strict_types=1);

namespace Evyex\RevenueCat;

use Evyex\RevenueCat\Model\ModelInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @template TData of ModelInterface
 */
readonly class Response
{
    public const HEADERS_KEY = 'headers';
    public const STATUS_CODE_KEY = 'status_code';
    protected array $data;

    /**
     * @param class-string<TData> $dataClass
     * @throws \JsonException
     */
    public function __construct(protected ResponseInterface $response, protected string $dataClass)
    {
        $decoded = json_decode($this->response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        if (!is_array($decoded)) {
            throw new \RuntimeException('RevenueCat response must decode to array');
        }

        $this->data = [
            ...$decoded,
            self::HEADERS_KEY => $this->response->getHeaders(),
            self::STATUS_CODE_KEY => $this->response->getStatusCode()
        ];
    }

    /**
     * @return TData
     */
    public function getData(): ModelInterface
    {
        return $this->dataClass::fromArray($this->data);
    }
}