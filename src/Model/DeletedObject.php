<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Model;

use Evyex\RevenueCat\Enum\DeletedObjectType;
use Evyex\RevenueCat\Normalizer;

readonly class DeletedObject implements ModelInterface
{
    private function __construct(
        private DeletedObjectType $object,
        private string $id,
        private \DateTimeImmutable $deletedAt,
    ) {
    }

    public static function fromArray(array $data): static
    {
        return new self(
            object: DeletedObjectType::from($data['object']),
            id: $data['id'],
            deletedAt: Normalizer::dateTime($data['deleted_at']),
        );
    }

    public function getObject(): DeletedObjectType
    {
        return $this->object;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getDeletedAt(): \DateTimeImmutable
    {
        return $this->deletedAt;
    }
}
