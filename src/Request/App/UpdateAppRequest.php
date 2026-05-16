<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Request\App;

use Evyex\RevenueCat\Model\App\App;
use Evyex\RevenueCat\Normalizer;
use Evyex\RevenueCat\Request\App\Create\Payload\AppCreatePayloadInterface;
use Evyex\RevenueCat\Request\Helpers\AuthTrait;
use Evyex\RevenueCat\Request\Helpers\ParamTrait;
use Evyex\RevenueCat\Request\RevenueCatRequestInterface;

class UpdateAppRequest implements RevenueCatRequestInterface
{
    use AuthTrait;
    use ParamTrait;

    public function __construct(
        #[\SensitiveParameter]
        private string $token,
        private string $projectId,
        private string $appId,
        private ?string $name = null,
        private ?AppCreatePayloadInterface $payload = null,
    ) {
        if ($this->name === null && $this->payload === null) {
            throw new \InvalidArgumentException('UpdateAppRequest requires at least one field to update.');
        }
    }

    public function method(): string
    {
        return 'POST';
    }

    public function path(): string
    {
        return Normalizer::path('/v2/projects/%s/apps/%s', $this->projectId, $this->appId);
    }

    public function query(): array
    {
        return [];
    }

    public function jsonBody(): ?array
    {
        $body = $this->argToArray(['name']);

        if ($this->payload !== null) {
            $body[$this->payload->appType()->value] = $this->payload->toArray();
        }

        return $body;
    }

    public static function dataClass(): string
    {
        return App::class;
    }
}
