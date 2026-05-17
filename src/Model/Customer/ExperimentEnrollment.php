<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Model\Customer;

use Evyex\RevenueCat\Model\ModelInterface;

readonly class ExperimentEnrollment implements ModelInterface
{
    private function __construct(
        private string $object,
        private string $id,
        private string $name,
        private string $variant,
    ) {
    }

    public static function fromArray(array $data): static
    {
        return new self(
            object: $data['object'],
            id: $data['id'],
            name: $data['name'],
            variant: $data['variant'],
        );
    }

    public function getObject(): string
    {
        return $this->object;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getVariant(): string
    {
        return $this->variant;
    }
}
