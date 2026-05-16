<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Request\App;

use Evyex\RevenueCat\Model\DeletedObject;
use Evyex\RevenueCat\Normalizer;
use Evyex\RevenueCat\Request\Helpers\AuthTrait;
use Evyex\RevenueCat\Request\Helpers\DeleteTrait;
use Evyex\RevenueCat\Request\RevenueCatRequestInterface;

final class DeleteAppRequest implements RevenueCatRequestInterface
{
    use AuthTrait;
    use DeleteTrait;

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

    public static function dataClass(): string
    {
        return DeletedObject::class;
    }
}
