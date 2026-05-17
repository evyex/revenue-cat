<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Model\ChartsMetrics;

use Evyex\RevenueCat\Enum\ChartsMetrics\ChartResolution;
use Evyex\RevenueCat\Model\ModelInterface;
use Evyex\RevenueCat\Model\PropertyBag;
use Evyex\RevenueCat\Normalizer;

class ChartData implements ModelInterface
{
    /**
     * @param array<int,array<int|float|string|bool|null>> $values
     * @param array<int,array{id:string,display_name:string}>|null $segmentsData
     * @param array<int,array<string,mixed>> $measuresData
     */
    private function __construct(
        private string $object,
        private string $category,
        private string $displayType,
        private string $displayName,
        private string $description,
        private ?string $documentationLink,
        private ?\DateTimeImmutable $lastComputedAt,
        private ?\DateTimeImmutable $startDate,
        private ?\DateTimeImmutable $endDate,
        private ?string             $yaxisCurrency,
        private ?bool               $filteringAllowed,
        private ?bool               $segmentingAllowed,
        private ChartResolution     $resolution,
        private array               $values,
        private ?PropertyBag        $summary,
        private string              $yaxis,
        private ?array              $segmentsData,
        private ?int                $segmentsLimit,
        private array               $measuresData,
        private ?PropertyBag        $userSelectors,
        private ?PropertyBag        $unsupportedParams,
    ) {
    }

    public static function fromArray(array $data): static
    {
        return new self(
            object: $data['object'],
            category: $data['category'],
            displayType: $data['display_type'],
            displayName: $data['display_name'],
            description: $data['description'],
            documentationLink: $data['documentation_link'] ?? null,
            lastComputedAt: isset($data['last_computed_at']) ? Normalizer::dateTime($data['last_computed_at']) : null,
            startDate: isset($data['start_date']) ? Normalizer::dateTime($data['start_date']) : null,
            endDate: isset($data['end_date']) ? Normalizer::dateTime($data['end_date']) : null,
            yaxisCurrency: $data['yaxis_currency'] ?? null,
            filteringAllowed: $data['filtering_allowed'] ?? null,
            segmentingAllowed: $data['segmenting_allowed'] ?? null,
            resolution: ChartResolution::from($data['resolution']),
            values: $data['values'] ?? [],
            summary: isset($data['summary']) ? PropertyBag::fromArray($data['summary']) : null,
            yaxis: $data['yaxis'] ?? null,
            segmentsData: $data['segments'] ?? null,
            segmentsLimit: $data['segments_limit'] ?? null,
            measuresData: $data['measures'] ?? [],
            userSelectors: isset($data['user_selectors']) ? PropertyBag::fromArray($data['user_selectors']) : null,
            unsupportedParams: isset($data['unsupported_params']) ? PropertyBag::fromArray($data['unsupported_params']) : null,
        );
    }

    public function getObject(): string { return $this->object; }
    public function getCategory(): string { return $this->category; }
    public function getDisplayType(): ?string { return $this->displayType; }
    public function getDisplayName(): string { return $this->displayName; }
    public function getDescription(): string { return $this->description; }
    public function getDocumentationLink(): ?string { return $this->documentationLink; }
    public function getLastComputedAt(): ?\DateTimeImmutable { return $this->lastComputedAt; }
    public function getStartDate(): ?\DateTimeImmutable { return $this->startDate; }
    public function getEndDate(): ?\DateTimeImmutable { return $this->endDate; }
    public function getYaxisCurrency(): ?string { return $this->yaxisCurrency; }
    public function isFilteringAllowed(): ?bool { return $this->filteringAllowed; }
    public function isSegmentingAllowed(): ?bool { return $this->segmentingAllowed; }
    public function getResolution(): ChartResolution { return $this->resolution; }
    public function getSummary(): ?PropertyBag { return $this->summary; }
    public function getYaxis(): string { return $this->yaxis; }
    public function getSegmentsLimit(): ?int { return $this->segmentsLimit; }
    public function getUserSelectors(): ?PropertyBag { return $this->userSelectors; }
    public function getUnsupportedParams(): ?PropertyBag { return $this->unsupportedParams; }

    /**
     * @return array<int, mixed>
     */
    public function getValues(): array
    {
       return $this->values;
    }

    /**
     * @return \Generator<ChartSegment>
     */
    public function getSegments(): \Generator
    {
        foreach ($this->segmentsData ?? [] as $segmentData) {
            yield ChartSegment::fromArray($segmentData);
        }
    }

    /**
     * @return \Generator<PropertyBag>
     */
    public function getMeasures(): \Generator
    {
        foreach ($this->measuresData as $measureData) {
            yield PropertyBag::fromArray($measureData);
        }
    }
}
