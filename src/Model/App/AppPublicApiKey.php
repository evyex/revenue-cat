<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Model\App;

use Evyex\RevenueCat\Model\Enum\Environment;
use Evyex\RevenueCat\Model\ModelInterface;
use Evyex\RevenueCat\Normalizer;

readonly class AppPublicApiKey implements ModelInterface
{
    private function __construct(
        private string $object,
        private string $id,
        private string $key,
        private Environment $environment,
        private string $appId,
        private \DateTimeImmutable $createdAt,
    )
    {
    }

    public static function fromArray(array $data): static
    {
        return new self(
            object: $data['object'],
            id: $data['id'],
            key: $data['key'],
            environment: Environment::from($data['environment']),
            appId: $data['app_id'],
            createdAt: Normalizer::dateTime($data['created_at']),
        );
    }

    public function getObject(): string
    {
        return $this->object;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getEnvironment(): Environment
    {
        return $this->environment;
    }

    public function getAppId(): string
    {
        return $this->appId;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }
}
