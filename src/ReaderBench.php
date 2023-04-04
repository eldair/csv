<?php

declare(strict_types=1);

namespace Eldair\Csv;

use PhpBench\Attributes as Bench;
use SplFileObject;
use function assert;

final class ReaderBench
{
    #[Bench\OutputTimeUnit('seconds')]
    #[Bench\Assert('mode(variant.mem.peak) < 2097152'), Bench\Assert('mode(variant.time.avg) < 10000000')]
    public function benchReading1MRowsCSVUsingSplFileObject(): void
    {
        $path = dirname(__DIR__).'/test_files/csv_with_one_million_rows.csv';

        $numReadRows = 0;
        foreach (Reader::createFromFileObject(new SplFileObject($path)) as $__) {
            ++$numReadRows;
        }

        assert(1_000_000 === $numReadRows);
    }

    #[Bench\OutputTimeUnit('seconds')]
    #[Bench\Assert('mode(variant.mem.peak) < 2097152'), Bench\Assert('mode(variant.time.avg) < 10000000')]
    public function benchReading1MRowsCSVUsingStream(): void
    {
        $path = dirname(__DIR__).'/test_files/csv_with_one_million_rows.csv';

        $numReadRows = 0;
        foreach (Reader::createFromPath($path) as $__) {
            ++$numReadRows;
        }

        assert(1_000_000 === $numReadRows);
    }
}
