<?php

declare(strict_types=1);

namespace Eldair\Csv\Query\Ordering;

use ArrayIterator;
use Closure;
use Eldair\Csv\Query\QueryException;
use Eldair\Csv\Query\Row;
use Eldair\Csv\Query\Sort;
use Iterator;
use OutOfBoundsException;
use ReflectionException;

use function is_array;
use function is_string;
use function iterator_to_array;
use function strtoupper;
use function trim;

/**
 * Enable sorting a record based on the value of a one of its cell.
 */
final class Column implements Sort
{
    private const ASCENDING = 'ASC';
    private const DESCENDING = 'DESC';

    /**
     * @param Closure(mixed, mixed): int $callback
     */
    private function __construct(
        public readonly string $direction,
        public readonly string|int $column,
        public readonly Closure $callback,
    ) {
    }

    /**
     * @param ?Closure(mixed, mixed): int $callback
     *
     * @throws QueryException
     */
    public static function sortOn(
        string|int $column,
        string|int $direction,
        ?Closure $callback = null
    ): self {

        $operator = match (true) {
            SORT_ASC === $direction => self::ASCENDING,
            SORT_DESC === $direction => self::DESCENDING,
            is_string($direction) => match (strtoupper(trim($direction))) {
                'ASC', 'ASCENDING', 'UP' => self::ASCENDING,
                'DESC', 'DESCENDING', 'DOWN' => self::DESCENDING,
                default => throw new QueryException('Unknown or unsupported ordering operator value: '.$direction),
            },
            default => throw new QueryException('Unknown or unsupported ordering operator value: '.$direction),
        };

        return new self(
            $operator,
            $column,
            $callback ?? static fn (mixed $first, mixed $second): int => $first <=> $second
        );
    }

    /**
     * @throws ReflectionException
     * @throws QueryException
     */
    public function __invoke(mixed $valueA, mixed $valueB): int
    {
        $first = Row::from($valueA)->value($this->column);
        $second = Row::from($valueB)->value($this->column);

        return match ($this->direction) {
            self::ASCENDING => ($this->callback)($first, $second),
            default => ($this->callback)($second, $first),
        };
    }

    public function sort(iterable $value): Iterator
    {
        $class = new class () extends ArrayIterator {
            public function seek(int $offset): void
            {
                try {
                    parent::seek($offset);
                } catch (OutOfBoundsException) {
                    return;
                }
            }
        };

        $it = new $class(!is_array($value) ? iterator_to_array($value) : $value);
        $it->uasort($this);

        return $it;
    }
}
