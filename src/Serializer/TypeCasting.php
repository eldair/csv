<?php

declare(strict_types=1);

namespace Eldair\Csv\Serializer;

/**
 * @template TValue
 */
interface TypeCasting
{
    /**
     * @throws TypeCastingFailed
     *
     * @return TValue
     */
    public function toVariable(?string $value): mixed;

    /**
     * Accepts additional parameters to configure the class
     * Parameters should be scalar value, null or array containing
     * only scalar value and null.
     *
     * @throws MappingFailed
     */
    public function setOptions(): void;
}
