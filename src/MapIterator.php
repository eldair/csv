<?php

declare(strict_types=1);

namespace Eldair\Csv;

use ArrayIterator;
use IteratorIterator;
use Traversable;

/**
 * Maps value from an iterator before yielding.
 *
 * @internal used internally to modify CSV content
 */
final class MapIterator extends IteratorIterator
{
    /** @var callable The callback to apply on all InnerIterator current value. */
    private $callable;

    public function __construct(Traversable $iterator, callable $callable)
    {
        parent::__construct($iterator);
        $this->callable = $callable;
    }

    public static function fromIterable(iterable $iterator, callable $callable): self
    {
        return match (true) {
            is_array($iterator) => new self(new ArrayIterator($iterator), $callable),
            default => new self($iterator, $callable),
        };
    }

    public function current(): mixed
    {
        return ($this->callable)(parent::current(), parent::key());
    }
}
