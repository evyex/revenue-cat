<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Model\Collaborator;

use Evyex\RevenueCat\Model\ModelInterface;
use Evyex\RevenueCat\Normalizer;

readonly class Collaborator implements ModelInterface
{
    private function __construct(
        private string $object,
        private string $id,
        private ?string $name,
        private string $email,
        private string $role,
        private ?\DateTimeImmutable $acceptedAt,
        private bool $hasMfa,
    ) {
    }

    public static function fromArray(array $data): static
    {
        return new self(
            object: $data['object'],
            id: $data['id'],
            name: $data['name'] ?? null,
            email: $data['email'],
            role: $data['role'],
            acceptedAt: isset($data['accepted_at']) ? Normalizer::dateTime($data['accepted_at']) : null,
            hasMfa: $data['has_mfa'],
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function getAcceptedAt(): ?\DateTimeImmutable
    {
        return $this->acceptedAt;
    }

    public function hasMfa(): bool
    {
        return $this->hasMfa;
    }
}
