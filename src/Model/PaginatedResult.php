<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Model;

/**
 * @template TItem of object
 */
final readonly class PaginatedResult
{
    /**
     * @param list<TItem> $items
     */
    public function __construct(
        public string $object,
        public array $items,
        public ?string $nextPage,
        public string $url,
    ) {
    }

    /**
     * @template TMapped of object
     * @param array<string,mixed> $data
     * @param callable(array<string,mixed>):TMapped $mapper
     * @return self<TMapped>
     */
    public static function fromArray(array $data, callable $mapper): self
    {
        $items = [];
        foreach ((array) ($data['items'] ?? []) as $item) {
            if (is_array($item)) {
                $items[] = $mapper($item);
            }
        }

        return new self(
            (string) ($data['object'] ?? 'list'),
            $items,
            isset($data['next_page']) ? (string) $data['next_page'] : null,
            (string) ($data['url'] ?? ''),
        );
    }
}
