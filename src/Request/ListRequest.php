<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Request;

use InvalidArgumentException;

final readonly class ListRequest
{
    public function __construct(
        public ?string $environment = null,
        public ?string $startingAfter = null,
        public ?int $limit = null,
    ) {
        if ($this->environment !== null && !in_array($this->environment, ['production', 'sandbox'], true)) {
            throw new InvalidArgumentException('ListRequest environment must be either "production" or "sandbox".');
        }
        if ($this->startingAfter !== null && trim($this->startingAfter) === '') {
            throw new InvalidArgumentException('ListRequest startingAfter must not be blank when provided.');
        }
        if ($this->limit !== null && $this->limit <= 0) {
            throw new InvalidArgumentException('ListRequest limit must be greater than 0.');
        }
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
