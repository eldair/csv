<?php

declare(strict_types=1);

namespace Eldair\Csv;

use Stringable;

/**
 * A class to insert records into a CSV Document.
 */
interface TabularDataWriter
{
    /**
     * Adds multiple records to the CSV document.
     *
     * @see TabularDataWriter::insertOne
     *
     * @param iterable<array<null|int|float|string|Stringable>> $records
     *
     * @throws CannotInsertRecord If the record can not be inserted
     * @throws Exception If the record can not be inserted
     */
    public function insertAll(iterable $records): int;

    /**
     * Adds a single record to a CSV document.
     *
     * A record is an array that can contain scalar type values, NULL values
     * or objects implementing the __toString method.
     *
     * @param array<null|int|float|string|Stringable> $record
     *
     * @throws CannotInsertRecord If the record can not be inserted
     * @throws Exception If the record can not be inserted
     */
    public function insertOne(array $record, bool $header): int;
}