<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Request\Customer;

use Evyex\RevenueCat\Model\Customer\CustomerList;
use Evyex\RevenueCat\Normalizer;
use Evyex\RevenueCat\Request\Helpers\AuthTrait;
use Evyex\RevenueCat\Request\Helpers\GetTrait;
use Evyex\RevenueCat\Request\Helpers\ParamTrait;
use Evyex\RevenueCat\Request\RevenueCatRequestInterface;

class ListCustomersRequest implements RevenueCatRequestInterface
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
        private ?string $search = null,
    ) {
    }

    public function path(): string
    {
        return Normalizer::path('/v2/projects/%s/customers', $this->projectId);
    }

    public function query(): array
    {
        return $this->argToArray(['startingAfter', 'limit', 'search']);
    }

    public static function dataClass(): string
    {
        return CustomerList::class;
    }
}
