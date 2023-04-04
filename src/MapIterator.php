<?php

declare(strict_types=1);

namespace Eldair\Csv;

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

    public function current(): mixed
    {
        return ($this->callable)(parent::current(), parent::key());
    }
}
