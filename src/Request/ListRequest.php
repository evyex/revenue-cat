<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Request;

final readonly class ListRequest
{
    public function __construct(
        public ?string $environment = null,
        public ?string $startingAfter = null,
        public ?int $limit = null,
    ) {
    }

    /** @return array<string,scalar> */
    public function toQuery(): array
    {
        $query = [];
        if ($this->environment !== null) {
            $query['environment'] = $this->environment;
        }
        if ($this->startingAfter !== null) {
            $query['starting_after'] = $this->startingAfter;
        }
        if ($this->limit !== null) {
            $query['limit'] = $this->limit;
        }

        return $query;
    }
}
