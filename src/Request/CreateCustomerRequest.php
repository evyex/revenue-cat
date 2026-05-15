<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Request;

use InvalidArgumentException;
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
        if (trim($this->id) === '') {
            throw new InvalidArgumentException('CreateCustomerRequest id must not be blank.');
        }
        foreach ($this->attributes as $attribute) {
            if (!$attribute instanceof CustomerAttribute) {
                throw new InvalidArgumentException('CreateCustomerRequest attributes must contain only CustomerAttribute objects.');
            }
        }
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
