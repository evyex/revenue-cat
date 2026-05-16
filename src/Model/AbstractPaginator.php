<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Model;

/**
 * @template TItem of ModelInterface
 */
abstract class AbstractPaginator implements ModelInterface
{
    /**
     * @return class-string<TItem>
     */
    abstract protected function getItemClass(): string;

    protected function __construct(
        protected string $object,
        protected ?string $nextPage,
        protected string $url,
        protected array $itemsData = [],
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new static($data['object'], $data['next_page'] ?? null, $data['url'], $data['items'] ?? []);
    }

    public function getObject(): string
    {
        return $this->object;
    }

    public function getNextPage(): ?string
    {
        return $this->nextPage;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return \Generator<TItem>
     */
    public function getItems(): \Generator
    {
        foreach ($this->itemsData as $itemData) {
            yield $this->getItemClass()::fromArray($itemData);
        }
    }
}