<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Request;

use Evyex\RevenueCat\Model\CustomerAttribute;

final readonly class CreateCustomerRequest
{
    /**
     * @param list<CustomerAttribute> $attributes
     */
    public function __construct(
        public string $id,
        public array $attributes = [],
    ) {
    }

    /** @return array<string,mixed> */
    public function toArray(): array
    {
        $attributes = [];
        foreach ($this->attributes as $attribute) {
            $attributes[] = $attribute->toArray();
        }

        return [
            'id' => $this->id,
            'attributes' => $attributes,
        ];
    }
}
