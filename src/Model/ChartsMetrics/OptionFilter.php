<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Model\ChartsMetrics;

use Evyex\RevenueCat\Model\ModelInterface;

class OptionFilter implements ModelInterface
{
    private function __construct(
        private string $id,
        private string $displayName,
        private ?string $groupDisplayName,
        private array $options,
    )
    {
    }

    public static function fromArray(array $data): ModelInterface
    {
        return new self(
            id: $data['id'],
            displayName: $data['display_name'],
            groupDisplayName: $data['group_display_name'] ?? null,
            options: $data['options'] ?? [],
        );
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getDisplayName(): string
    {
        return $this->displayName;
    }

    public function getGroupDisplayName(): ?string
    {
        return $this->groupDisplayName;
    }

    /** @return \Generator<OptionFilterOption> */
    public function getOptions(): \Generator
    {
        foreach ($this->options as $option) {
            yield OptionFilterOption::fromArray($option);
        }
    }
}