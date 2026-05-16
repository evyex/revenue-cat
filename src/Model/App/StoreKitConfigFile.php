<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Model\App;

use Evyex\RevenueCat\Model\ModelInterface;
use Evyex\RevenueCat\Model\PropertyBag;

readonly class StoreKitConfigFile implements ModelInterface
{
    private function __construct(
        private string $object,
        private PropertyBag $contents,
    ) {
    }

    public static function fromArray(array $data): static
    {
        return new self(
            object: $data['object'],
            contents: PropertyBag::fromArray($data['contents']),
        );
    }

    public function getObject(): string
    {
        return $this->object;
    }

    public function getContents(): PropertyBag
    {
        return $this->contents;
    }
}
