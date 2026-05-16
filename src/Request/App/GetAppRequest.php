<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Request\App;

use Evyex\RevenueCat\Model\App\App;
use Evyex\RevenueCat\Normalizer;
use Evyex\RevenueCat\Request\Helpers\AuthTrait;
use Evyex\RevenueCat\Request\Helpers\GetTrait;
use Evyex\RevenueCat\Request\RevenueCatRequestInterface;

class GetAppRequest implements RevenueCatRequestInterface
{
    use AuthTrait;
    use GetTrait;

    public function __construct(
        #[\SensitiveParameter]
        private string $token,
        private string $projectId,
        private string $appId,
    ) {
    }

    public function path(): string
    {
        return Normalizer::path('/v2/projects/%s/apps/%s', $this->projectId, $this->appId);
    }

    public function query(): array
    {
        return [];
    }

    public static function dataClass(): string
    {
        return App::class;
    }
}
