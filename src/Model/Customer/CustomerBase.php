<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Model\Customer;

use Evyex\RevenueCat\Model\ModelInterface;
use Evyex\RevenueCat\Normalizer;

readonly class CustomerBase implements ModelInterface
{
    private function __construct(
        private string $object,
        private string $id,
        private string $projectId,
        private \DateTimeImmutable $firstSeenAt,
        private ?\DateTimeImmutable $lastSeenAt,
        private ?string $lastSeenAppVersion,
        private ?string $lastSeenCountry,
        private ?string $lastSeenPlatform,
        private ?string $lastSeenPlatformVersion,
        private ?CustomerActiveEntitlementList $activeEntitlements,
        private ?ExperimentEnrollment $experiment,
        private ?CustomerAttributeList $attributes,
    ) {
    }

    public static function fromArray(array $data): static
    {
        return new self(
            object: $data['object'],
            id: $data['id'],
            projectId: $data['project_id'],
            firstSeenAt: Normalizer::dateTime($data['first_seen_at']),
            lastSeenAt: isset($data['last_seen_at']) ? Normalizer::dateTime($data['last_seen_at']) : null,
            lastSeenAppVersion: $data['last_seen_app_version'],
            lastSeenCountry: $data['last_seen_country'],
            lastSeenPlatform: $data['last_seen_platform'],
            lastSeenPlatformVersion: $data['last_seen_platform_version'],
            activeEntitlements: isset($data['active_entitlements']) ? CustomerActiveEntitlementList::fromArray($data['active_entitlements']) : null,
            experiment: isset($data['experiment']) ? ExperimentEnrollment::fromArray($data['experiment']) : null,
            attributes: isset($data['attributes']) ? CustomerAttributeList::fromArray($data['attributes']) : null,
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

    public function getFirstSeenAt(): \DateTimeImmutable
    {
        return $this->firstSeenAt;
    }

    public function getLastSeenAt(): ?\DateTimeImmutable
    {
        return $this->lastSeenAt;
    }

    public function getLastSeenAppVersion(): ?string
    {
        return $this->lastSeenAppVersion;
    }

    public function getLastSeenCountry(): ?string
    {
        return $this->lastSeenCountry;
    }

    public function getLastSeenPlatform(): ?string
    {
        return $this->lastSeenPlatform;
    }

    public function getLastSeenPlatformVersion(): ?string
    {
        return $this->lastSeenPlatformVersion;
    }

    public function getActiveEntitlements(): ?CustomerActiveEntitlementList
    {
        return $this->activeEntitlements;
    }

    public function getExperiment(): ?ExperimentEnrollment
    {
        return $this->experiment;
    }

    public function getAttributes(): ?CustomerAttributeList
    {
        return $this->attributes;
    }
}
