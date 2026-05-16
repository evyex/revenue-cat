<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Model\AuditLog;

use Evyex\RevenueCat\Enum\AuditLogActorType;
use Evyex\RevenueCat\Model\ModelInterface;
use Evyex\RevenueCat\Model\PropertyBag;
use Evyex\RevenueCat\Normalizer;

readonly class AuditLog implements ModelInterface
{
    private function __construct(
        private string $object,
        private string $id,
        private string $projectId,
        private string $actionType,
        private string $targetType,
        private string $targetIdentifier,
        private AuditLogActorType $actorType,
        private string $actorIdentifier,
        private \DateTimeImmutable $occurredAt,
        private PropertyBag $additionalData,
    ) {
    }

    public static function fromArray(array $data): static
    {
        return new self(
            object: $data['object'],
            id: $data['id'],
            projectId: $data['project_id'],
            actionType: $data['action_type'],
            targetType: $data['target_type'],
            targetIdentifier: $data['target_identifier'],
            actorType: AuditLogActorType::from($data['actor_type']),
            actorIdentifier: $data['actor_identifier'],
            occurredAt: Normalizer::dateTime($data['occurred_at']),
            additionalData: PropertyBag::fromArray($data['additional_data']),
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

    public function getProjectId(): string
    {
        return $this->projectId;
    }

    public function getActionType(): string
    {
        return $this->actionType;
    }

    public function getTargetType(): string
    {
        return $this->targetType;
    }

    public function getTargetIdentifier(): string
    {
        return $this->targetIdentifier;
    }

    public function getActorType(): AuditLogActorType
    {
        return $this->actorType;
    }

    public function getActorIdentifier(): string
    {
        return $this->actorIdentifier;
    }

    public function getOccurredAt(): \DateTimeImmutable
    {
        return $this->occurredAt;
    }

    public function getAdditionalData(): PropertyBag
    {
        return $this->additionalData;
    }
}
