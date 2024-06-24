<?php

declare(strict_types=1);

namespace Eldair\Csv\Query\Constraint;

use Eldair\Csv\Query\QueryException;
use Eldair\Csv\Query\QueryTestCase;
use PHPUnit\Framework\Attributes\Test;

final class OffsetTest extends QueryTestCase
{
    #[Test]
    public function it_can_filter_the_tabular_data_based_on_the_offset_value(): void
    {
        $predicate = Offset::filterOn('<', 2);
        $result = $this->stmt->where($predicate)->process($this->document);

        self::assertCount(1, $result);
    }

    #[Test]
    public function it_can_filter_the_tabular_data_based_on_the_offset_value_and_a_callback(): void
    {
        $predicate = Offset::filterOn(fn (int $key): bool => 0 === $key % 2);
        $result = $this->stmt->where($predicate)->process($this->document);

        self::assertCount(2, $result);
    }

    #[Test]
    public function it_will_throw_if_the_offset_values_are_invalidf(): void
    {
        $this->expectException(QueryException::class);

        Offset::filterOn('NOT IN', 'Dakar');
    }
}
