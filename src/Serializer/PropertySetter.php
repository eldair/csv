<?php

declare(strict_types=1);

namespace Eldair\Csv\Serializer;

use ReflectionException;
use ReflectionMethod;
use ReflectionProperty;

/**
 * @internal
 */
final class PropertySetter
{
    public function __construct(
        private readonly ReflectionMethod|ReflectionProperty $accessor,
        public readonly int $offset,
        private readonly TypeCasting $cast,
    ) {
    }

    /**
     * @throws ReflectionException
     */
    public function __invoke(object $object, ?string $value): void
    {
        $typeCastedValue = $this->cast->toVariable($value);

        match (true) {
            $this->accessor instanceof ReflectionMethod => $this->accessor->invoke($object, $typeCastedValue),
            $this->accessor instanceof ReflectionProperty => $this->accessor->setValue($object, $typeCastedValue),
        };
    }
}
