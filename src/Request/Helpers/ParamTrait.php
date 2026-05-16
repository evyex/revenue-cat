<?php

declare(strict_types=1);

namespace Evyex\RevenueCat\Request\Helpers;

use Evyex\RevenueCat\Normalizer;
use BackedEnum;

trait ParamTrait
{
    protected function argToArray(array $properties): array
    {
        $array = [];
        foreach ($properties as $property) {
            $value = $this->$property;
            if ($value instanceof BackedEnum) {
                $value = $value->value;
            }
            if ($value !== null && $value !== '') {
                $array[Normalizer::camelToSnake($property)] = $value;
            }
        }

        return $array;
    }

    protected function paginationQuery(): array
    {
        return $this->argToArray(['startingAfter', 'limit']);
    }
}
