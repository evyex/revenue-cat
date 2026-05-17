<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Request\Collaborator;

use Evyex\RevenueCat\Model\Collaborator\CollaboratorList;
use Evyex\RevenueCat\Normalizer;
use Evyex\RevenueCat\Request\Helpers\AuthTrait;
use Evyex\RevenueCat\Request\Helpers\GetTrait;
use Evyex\RevenueCat\Request\Helpers\ParamTrait;
use Evyex\RevenueCat\Request\RevenueCatRequestInterface;

class ListCollaboratorsRequest implements RevenueCatRequestInterface
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
        return Normalizer::path('/v2/projects/%s/collaborators', $this->projectId);
    }

    public function query(): array
    {
        return $this->paginationQuery();
    }

    public static function dataClass(): string
    {
        return CollaboratorList::class;
    }
}
