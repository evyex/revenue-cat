<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Model\App;

use Evyex\RevenueCat\Model\ModelInterface;

readonly class StoreKitConfigFile implements ModelInterface
{
    private function __construct(
        private string $object,
        private StoreKitConfigContents $contents,
    ) {
    }

    public static function fromArray(array $data): static
    {
        return new self(
            object: $data['object'],
            contents: StoreKitConfigContents::fromArray($data['contents']),
        );
    }

    public function getObject(): string
    {
        return $this->object;
    }

    public function getContents(): StoreKitConfigContents
    {
        return $this->contents;
    }
}
