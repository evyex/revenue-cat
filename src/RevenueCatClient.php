<?php

declare(strict_types=1);

namespace Evyex\RevenueCat;

use Evyex\RevenueCat\Http\ApiTransport;
use Evyex\RevenueCat\Model\Customer;
use Evyex\RevenueCat\Model\CustomerActiveEntitlement;
use Evyex\RevenueCat\Model\PaginatedResult;
use Evyex\RevenueCat\Model\Purchase;
use Evyex\RevenueCat\Model\Subscription;
use Evyex\RevenueCat\Request\CreateCustomerRequest;
use Evyex\RevenueCat\Request\ListRequest;

final readonly class RevenueCatClient
{
    public function __construct(
        private ApiTransport $transport,
        private Config $config,
    ) {
    }

    public static function build(ApiTransport $transport, Config $config): self
    {
        return new self($transport->withAuthToken($config->apiKey), $config);
    }

    public function createCustomer(CreateCustomerRequest $request): Customer
    {
        $data = $this->transport->request(
            'POST',
            sprintf('/projects/%s/customers', rawurlencode($this->config->projectId)),
            body: $request->toArray(),
        );

        return Customer::fromArray($data);
    }

    public function getCustomer(string $customerId, bool $expandAttributes = false): Customer
    {
        $query = [];
        if ($expandAttributes) {
            $query['expand[]'] = 'attributes';
        }

        $data = $this->transport->request(
            'GET',
            sprintf('/projects/%s/customers/%s', rawurlencode($this->config->projectId), rawurlencode($customerId)),
            query: $query,
        );

        return Customer::fromArray($data);
    }

    /** @return PaginatedResult<Subscription> */
    public function listSubscriptions(string $customerId, ListRequest $request = new ListRequest()): PaginatedResult
    {
        $data = $this->transport->request(
            'GET',
            sprintf('/projects/%s/customers/%s/subscriptions', rawurlencode($this->config->projectId), rawurlencode($customerId)),
            query: $request->toQuery(),
        );

        return PaginatedResult::fromArray($data, Subscription::fromArray(...));
    }

    /** @return PaginatedResult<Purchase> */
    public function listPurchases(string $customerId, ListRequest $request = new ListRequest()): PaginatedResult
    {
        $data = $this->transport->request(
            'GET',
            sprintf('/projects/%s/customers/%s/purchases', rawurlencode($this->config->projectId), rawurlencode($customerId)),
            query: $request->toQuery(),
        );

        return PaginatedResult::fromArray($data, Purchase::fromArray(...));
    }

    /** @return PaginatedResult<CustomerActiveEntitlement> */
    public function listActiveEntitlements(string $customerId, ListRequest $request = new ListRequest()): PaginatedResult
    {
        $data = $this->transport->request(
            'GET',
            sprintf('/projects/%s/customers/%s/active_entitlements', rawurlencode($this->config->projectId), rawurlencode($customerId)),
            query: $request->toQuery(),
        );

        return PaginatedResult::fromArray($data, CustomerActiveEntitlement::fromArray(...));
    }
}
