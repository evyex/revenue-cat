<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Model\Store;

use Evyex\RevenueCat\Model\ModelInterface;

readonly class MacAppStore implements ModelInterface
{
    public function __construct(private string $bundleId)
    {
    }

    public static function fromArray(array $data): static
    {
        return new self(bundleId: $data['bundle_id']);
    }

    public function getBundleId(): string
    {
        return $this->bundleId;
    }
}
