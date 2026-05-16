<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Model\Store;

use Evyex\RevenueCat\Model\ModelInterface;

final readonly class PlayStore implements ModelInterface
{
    public function __construct(private string $packageName)
    {
    }

    public static function fromArray(array $data): static
    {
        return new self(packageName: $data['package_name']);
    }

    public function getPackageName(): string
    {
        return $this->packageName;
    }
}
