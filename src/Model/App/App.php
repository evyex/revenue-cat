<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Model\App;

use Evyex\RevenueCat\Model\ModelInterface;
use Evyex\RevenueCat\Normalizer;

final readonly class App implements ModelInterface
{
    private function __construct(
        private string $object,
        private string $id,
        private string $name,
        private int $createdAtMs,
        private string $type,
        private string $projectId,
    ) {
    }

    public static function fromArray(array $data): static
    {
        return new self(
            object: (string) ($data['object'] ?? 'app'),
            id: (string) ($data['id'] ?? ''),
            name: (string) ($data['name'] ?? ''),
            createdAtMs: (int) ($data['created_at'] ?? 0),
            type: (string) ($data['type'] ?? ''),
            projectId: (string) ($data['project_id'] ?? ''),
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

    public function getCreatedAt(): \DateTimeImmutable
    {
        return Normalizer::dateTime($this->createdAtMs);
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getProjectId(): string
    {
        return $this->projectId;
    }
}
