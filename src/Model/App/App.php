<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Model\App;

use Evyex\RevenueCat\Enum\AppType;
use Evyex\RevenueCat\Model\ModelInterface;
use Evyex\RevenueCat\Model\Store\Amazon;
use Evyex\RevenueCat\Model\Store\AppStore;
use Evyex\RevenueCat\Model\Store\MacAppStore;
use Evyex\RevenueCat\Model\Store\Paddle;
use Evyex\RevenueCat\Model\Store\PlayStore;
use Evyex\RevenueCat\Model\Store\RcBilling;
use Evyex\RevenueCat\Model\Store\Roku;
use Evyex\RevenueCat\Model\Store\Stripe;
use Evyex\RevenueCat\Normalizer;

readonly class App implements ModelInterface
{
    private function __construct(
        private string $object,
        private string $id,
        private string $name,
        private \DateTimeImmutable $createdAt,
        private AppType $type,
        private string $projectId,
        private ?Amazon $amazon = null,
        private ?AppStore $appStore = null,
        private ?MacAppStore $macAppStore = null,
        private ?PlayStore $playStore = null,
        private ?Stripe $stripe = null,
        private ?RcBilling $rcBilling = null,
        private ?Roku $roku = null,
        private ?Paddle $paddle = null,
        private array $properties = [],
    ) {
    }

    public static function fromArray(array $data): static
    {
        return new self(
            object: $data['object'],
            id: $data['id'],
            name: $data['name'],
            createdAt: Normalizer::dateTime($data['created_at']),
            type: AppType::from($data['type']),
            projectId: $data['project_id'],
            amazon: isset($data['amazon']) ? Amazon::fromArray($data['amazon']) : null,
            appStore: isset($data['app_store']) ? AppStore::fromArray($data['app_store']) : null,
            macAppStore: isset($data['mac_app_store']) ? MacAppStore::fromArray($data['mac_app_store']) : null,
            playStore: isset($data['play_store']) ? PlayStore::fromArray($data['play_store']) : null,
            stripe: isset($data['stripe']) ? Stripe::fromArray($data['stripe']) : null,
            rcBilling: isset($data['rc_billing']) ? RcBilling::fromArray($data['rc_billing']) : null,
            roku: isset($data['roku']) ? Roku::fromArray($data['roku']) : null,
            paddle: isset($data['paddle']) ? Paddle::fromArray($data['paddle']) : null,
            properties: $data,
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
        return $this->createdAt;
    }

    public function getType(): AppType
    {
        return $this->type;
    }

    public function getProjectId(): string
    {
        return $this->projectId;
    }

    public function getAmazon(): ?Amazon
    {
        return $this->amazon;
    }  

    public function getAppStore(): ?AppStore
    {
        return $this->appStore;
    }

    public function getMacAppStore(): ?MacAppStore
    {
        return $this->macAppStore;
    }

    public function getPlayStore(): ?PlayStore
    {
        return $this->playStore;
    }

    public function getStripe(): ?Stripe
    {
        return $this->stripe;
    }

    public function getRcBilling(): ?RcBilling
    {
        return $this->rcBilling;
    }

    public function getRoku(): ?Roku
    {
        return $this->roku;
    }

    public function getPaddle(): ?Paddle
    {
        return $this->paddle;
    }

    public function getProperty(string $propertyName): mixed
    {
        return $this->properties[$propertyName] ?? null;
    }
}
