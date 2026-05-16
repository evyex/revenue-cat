<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Request\App;

use Evyex\RevenueCat\Model\App\AppListPublicApiKey;
use Evyex\RevenueCat\Normalizer;
use Evyex\RevenueCat\Request\Helpers\AuthTrait;
use Evyex\RevenueCat\Request\Helpers\GetTrait;
use Evyex\RevenueCat\Request\RevenueCatRequestInterface;

class AppPublicApiKeysRequest implements RevenueCatRequestInterface
{
    use AuthTrait;
    use GetTrait;

    public function __construct(
        #[\SensitiveParameter]
        private string $token,
        private string $appId,
        private string $projectId,
    )
    {
    }

    public function path(): string
    {
        return Normalizer::path('/v2/projects/%s/apps/%s/public_api_keys', $this->projectId, $this->appId);
    }

    public function query(): array
    {
        return [];
    }

    public static function dataClass(): string
    {
        return AppListPublicApiKey::class;
    }
}