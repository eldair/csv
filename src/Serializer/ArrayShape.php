<?php

namespace Eldair\Csv\Serializer;

use function in_array;

enum ArrayShape: string
{
    case List = 'list';
    case Csv = 'csv';
    case Json = 'json';

    public function equals(mixed $value): bool
    {
        return $value instanceof self
            && $value === $this;
    }

    public function isOneOf(self ...$types): bool
    {
        return in_array($this, $types, true);
    }
}
