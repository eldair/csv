<?php

declare(strict_types=1);

namespace Eldair\Csv\Query\Constraint;

use CallbackFilterIterator;
use Closure;
use Eldair\Csv\MapIterator;
use Eldair\Csv\Query;
use Iterator;
use ReflectionException;

/**
 * Enable filtering a record based on the value of a one of its cell.
 *
 * When used with PHP's array_filter with the ARRAY_FILTER_USE_BOTH flag
 * the record offset WILL NOT BE taken into account
 */
final class Column implements Query\Predicate
{
    /**
     * @throws Query\QueryException
     */
    private function __construct(
        public readonly string|int $column,
        public readonly Comparison|Closure $operator,
        public readonly mixed $value,
    ) {
        if (!$this->operator instanceof Closure) {
            $this->operator->accept($this->value);
        }
    }

    /**
     * @throws Query\QueryException
     */
    public static function filterOn(
        string|int $column,
        Comparison|Closure|callable|string $operator,
        mixed $value = null,
    ): self {
        if ($operator instanceof Closure) {
            return new self($column, $operator, null);
        }

        if (is_callable($operator)) {
            return new self($column, $operator(...), $value);
        }

        return new self(
            $column,
            is_string($operator) ? Comparison::fromOperator($operator) : $operator,
            $value
        );
    }

    /**
     * @throws ReflectionException
     * @throws Query\QueryException
     */
    public function __invoke(mixed $value, int|string $key): bool
    {
        $subject = Query\Row::from($value)->value($this->column);
        if ($this->operator instanceof Closure) {
            return ($this->operator)($subject);
        }

        return $this->operator->compare($subject, $this->value);
    }

    public function filter(iterable $value): Iterator
    {
        return new CallbackFilterIterator(MapIterator::toIterator($value), $this);
    }
}
