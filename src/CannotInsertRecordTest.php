<?php

declare(strict_types=1);

namespace Eldair\Csv;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

#[Group('csv')]
final class CannotInsertRecordTest extends TestCase
{
    public function testTriggerOnInsertion(): void
    {
        $record = ['jane', 'doe', 'jane.doe@example.com'];
        $exception = CannotInsertRecord::triggerOnInsertion($record);

        self::assertSame($record, $exception->getRecord());
        self::assertSame('', $exception->getName());
        self::assertSame('Unable to write record to the CSV document', $exception->getMessage());
    }

    public function testTriggerOnValidation(): void
    {
        $record = ['jane', 'doe', 'jane.doe@example.com'];
        $exception = CannotInsertRecord::triggerOnValidation('foo bar', $record);

        self::assertSame($record, $exception->getRecord());
        self::assertSame('foo bar', $exception->getName());
        self::assertSame('Record validation failed', $exception->getMessage());
    }
}
