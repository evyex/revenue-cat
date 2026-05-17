<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Model\ChartsMetrics;

use Evyex\RevenueCat\Model\ModelInterface;
use Evyex\RevenueCat\Model\PropertyBag;

class ChartOptions implements ModelInterface
{
    /**
     * @param array<int,array<string,mixed>> $resolutionsData
     * @param array<int,array<string,mixed>> $segmentsData
     * @param array<int,array<string,mixed>> $filtersData
     */
    private function __construct(
        private string $object,
        private array $resolutionsData,
        private array $segmentsData,
        private array $filtersData,
        private ?PropertyBag $userSelectors,
    ) {
    }

    public static function fromArray(array $data): static
    {
        return new self(
            object: $data['object'],
            resolutionsData: $data['resolutions'],
            segmentsData: $data['segments'],
            filtersData: $data['filters'],
            userSelectors:isset($data['user_selectors']) ? PropertyBag::fromArray($data['user_selectors']) : null,
        );
    }

    public function getObject(): string
    {
        return $this->object;
    }

    /**
     * @return \Generator<OptionResolution>
     */
    public function getResolutions(): \Generator
    {
        foreach ($this->resolutionsData as $item) {
            yield OptionResolution::fromArray($item);
        }
    }

    /**
     * @return \Generator<OptionSegment>
     */
    public function getSegments(): \Generator
    {
        foreach ($this->segmentsData as $item) {
            yield OptionSegment::fromArray($item);
        }
    }

    /**
     * @return \Generator<OptionResolution>
     */
    public function getFilters(): \Generator
    {
        foreach ($this->filtersData as $item) {
            yield OptionFilter::fromArray($item);
        }
    }

    public function getUserSelectors(): ?PropertyBag
    {
        return $this->userSelectors;
    }
}
