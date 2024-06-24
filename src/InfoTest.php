<?php

declare(strict_types=1);

namespace Eldair\Csv;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use SplTempFileObject;
use TypeError;

#[Group('csv')]
final class InfoTest extends TestCase
{
    public function testDetectDelimiterListWithInvalidRowLimit(): void
    {
        $this->expectException(Exception::class);

        $file = new SplTempFileObject();
        $file->fwrite("How are you today ?\nI'm doing fine thanks!");
        $csv = Reader::createFromFileObject($file);

        Info::getDelimiterStats($csv, [','], -4);
    }

    public function testDetectDelimiterListWithInvalidDelimiter(): void
    {
        $this->expectException(TypeError::class);

        $file = new SplTempFileObject();
        $file->fwrite("How are you today ?\nI'm doing fine thanks!");
        $csv = Reader::createFromFileObject($file);

        Info::getDelimiterStats($csv, [',', []]); /* @phpstan-ignore-line */
    }

    public function testDetectDelimiterListWithNoCSV(): void
    {
        $file = new SplTempFileObject();
        $file->fwrite("How are you today ?\nI'm doing fine thanks!");
        $csv = Reader::createFromFileObject($file);

        self::assertSame(['toto' => 0, '|' => 0], Info::getDelimiterStats($csv, ['toto', '|'], 5));
    }

    public function testDetectDelimiterWithNoValidDelimiter(): void
    {
        $file = new SplTempFileObject();
        $file->fwrite("How are you today ?\nI'm doing fine thanks!");
        $csv = Reader::createFromFileObject($file);

        self::assertSame(['toto' => 0], Info::getDelimiterStats($csv, ['toto'], 5));
    }

    public function testDetectDelimiterListWithInconsistentCSV(): void
    {
        $data = new SplTempFileObject();
        $data->setCsvControl(';');
        $data->fputcsv(['toto', 'tata', 'tutu']);
        $data->setCsvControl('|');
        $data->fputcsv(['toto', 'tata', 'tutu']);
        $data->fputcsv(['toto', 'tata', 'tutu']);
        $data->fputcsv(['toto', 'tata', 'tutu']);

        self::assertSame(
            ['|' => 12, ';' => 4],
            Info::getDelimiterStats(Reader::createFromFileObject($data), ['|', ';'], 5)
        );
    }

    public function testDetectDelimiterKeepOriginalDelimiter(): void
    {
        $file = new SplTempFileObject();
        $file->fwrite("How are you today ?\nI'm doing fine thanks!");
        $csv = Reader::createFromFileObject($file);
        $csv->setDelimiter('@');

        Info::getDelimiterStats($csv, ['toto', '|'], 5);

        self::assertSame('@', $csv->getDelimiter());
    }

    public function testExpectedLimitIsUsedIssue366(): void
    {
        $text = <<<EOF
foo;bar;hello_world
42;1,2,3,4,5;true
EOF;
        $expected = [';' => 4, ',' => 0];
        $reader = Reader::createFromString($text);

        self::assertSame($expected, Info::getDelimiterStats($reader, [';', ','], 1));
    }
}
