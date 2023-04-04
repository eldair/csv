<?php

declare(strict_types=1);

namespace Eldair\Csv;

use function count;

/**
 * Validates column consistency when inserting records into a CSV document.
 */
class ColumnConsistency
{
    /**
     * @throws InvalidArgument if the column count is less than -1
     */
    public function __construct(
        protected int $columns_count = -1
    ) {
        if ($this->columns_count < -1) {
            throw InvalidArgument::dueToInvalidColumnCount($this->columns_count, __METHOD__);
        }
    }

    /**
     * Returns the column count.
     */
    public function getColumnCount(): int
    {
        return $this->columns_count;
    }

    /**
     * Tells whether the submitted record is valid.
     */
    public function __invoke(array $record): bool
    {
        $count = count($record);
        if (-1 === $this->columns_count) {
            $this->columns_count = $count;

            return true;
        }

        return $count === $this->columns_count;
    }
}
