<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Request\App;

use Evyex\RevenueCat\Model\App\AppList;
use Evyex\RevenueCat\Normalizer;
use Evyex\RevenueCat\Request\Helpers\AuthTrait;
use Evyex\RevenueCat\Request\Helpers\GetTrait;
use Evyex\RevenueCat\Request\Helpers\ParamTrait;
use Evyex\RevenueCat\Request\RevenueCatRequestInterface;

final class ListAppsRequest implements RevenueCatRequestInterface
{
    use AuthTrait;
    use GetTrait;
    use ParamTrait;

    public function __construct(
        #[\SensitiveParameter]
        private string $token,
        private string $projectId,
        private ?string $startingAfter = null,
        private ?int $limit = null,
    ) {
    }

    public function path(): string
    {
        return Normalizer::path('/v2/projects/%s/apps', $this->projectId);
    }

    public function query(): array
    {
        return $this->paginationQuery();
    }

    public static function dataClass(): string
    {
        return AppList::class;
    }
}
