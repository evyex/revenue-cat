<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Request\App;

use Evyex\RevenueCat\Model\App\App;
use Evyex\RevenueCat\Normalizer;
use Evyex\RevenueCat\Request\App\Create\Payload\AppCreatePayloadInterface;
use Evyex\RevenueCat\Request\Helpers\AuthTrait;
use Evyex\RevenueCat\Request\RevenueCatRequestInterface;

final class CreateAppRequest implements RevenueCatRequestInterface
{
    use AuthTrait;

    public function __construct(
        #[\SensitiveParameter]
        private string $token,
        private string $projectId,
        private string $name,
        private AppCreatePayloadInterface $payload,
    ) {
    }

    public function method(): string
    {
        return 'POST';
    }

    public function path(): string
    {
        return Normalizer::path('/v2/projects/%s/apps', $this->projectId);
    }

    public function query(): array
    {
        return [];
    }

    public function jsonBody(): ?array
    {
        return [
            'name' => $this->name,
            'type' => $this->payload->appType()->value,
            $this->payload->appType()->value => $this->payload->toArray(),
        ];
    }

    public static function dataClass(): string
    {
        return App::class;
    }
}
