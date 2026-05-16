<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Request\AuditLog;

use Evyex\RevenueCat\Model\AuditLog\AuditLogList;
use Evyex\RevenueCat\Normalizer;
use Evyex\RevenueCat\Request\Helpers\AuthTrait;
use Evyex\RevenueCat\Request\Helpers\GetTrait;
use Evyex\RevenueCat\Request\Helpers\ParamTrait;
use Evyex\RevenueCat\Request\RevenueCatRequestInterface;

class ListAuditLogsRequest implements RevenueCatRequestInterface
{
    use AuthTrait;
    use GetTrait;
    use ParamTrait;

    public function __construct(
        #[\SensitiveParameter]
        private string $token,
        private string $projectId,
        private ?string $startingAfter = null,
        private ?string $startDate = null,
        private ?string $endDate = null,
        private ?int $limit = null,
    ) {
    }

    public function path(): string
    {
        return Normalizer::path('/v2/projects/%s/audit_logs', $this->projectId);
    }

    public function query(): array
    {
        return $this->argToArray(['startingAfter', 'startDate', 'endDate', 'limit']);
    }

    public static function dataClass(): string
    {
        return AuditLogList::class;
    }
}
