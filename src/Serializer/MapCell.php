<?php

declare(strict_types=1);

namespace Eldair\Csv\Serializer;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
final class MapCell
{
    /**
     * @param class-string|string|null $cast
     */
    public function __construct(
        public readonly string|int|null $column = null,
        public readonly ?string $cast = null,
        public readonly array $options = [],
        public readonly bool $ignore = false,
    ) {
    }
}
