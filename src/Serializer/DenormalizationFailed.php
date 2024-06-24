<?php

declare(strict_types=1);

namespace Eldair\Csv\Serializer;

use ReflectionProperty;
use RuntimeException;

final class DenormalizationFailed extends RuntimeException implements SerializationFailed
{
    public static function dueToUninitializedProperty(ReflectionProperty $reflectionProperty): self
    {
        return new self('The property '.$reflectionProperty->getDeclaringClass()->getName().'::'.$reflectionProperty->getName().' is not initialized; its value is missing from the source data.');
    }
}
