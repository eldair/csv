<?php

declare(strict_types=1);

namespace Eldair\Csv\Query;

use Iterator;

/**
 * Enable filtering a record based on its value and/or its offset.
 *
 * The class can be used directly with PHP's
 * <ol>
 * <li>array_filter with the ARRAY_FILTER_USE_BOTH flag.</li>
 * <li>CallbackFilterIterator class.</li>
 * </ol>
 */
interface Predicate
{
    /**
     * The class predicate method.
     *
     * Evaluates each element of an iterable structure based on its value and its offset.
     * The method must return true if the predicate is satisfied, false otherwise.
     */
    public function __invoke(mixed $value, string|int $key): bool;

    /**
     * Filters elements of an iterable structure using the class predicate method.
     *
     * @see Predicate::__invoke
     */
    public function filter(iterable $value): Iterator;
}
