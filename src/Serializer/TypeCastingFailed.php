<?php

declare(strict_types=1);

namespace Eldair\Csv\Serializer;

use RuntimeException;
use Throwable;

final class TypeCastingFailed extends RuntimeException implements SerializationFailed
{
    public static function dueToNotNullableType(string $type, ?Throwable $exception = null): self
    {
        return new self('The `null` value can not be cast to an `'.$type.'`; the property type is not nullable.', 0, $exception);
    }

    public static function dueToInvalidValue(string $value, string $type, ?Throwable $previous = null): self
    {
        return new self('Unable to cast the given data `'.$value.'` to a `'.$type.'`.', 0, $previous);
    }
}
