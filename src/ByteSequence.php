<?php

namespace Eldair\Csv;

/**
 * Defines constants for common BOM sequences.
 */
interface ByteSequence
{
    public const BOM_UTF8 = "\xEF\xBB\xBF";
    public const BOM_UTF16_BE = "\xFE\xFF";
    public const BOM_UTF16_LE = "\xFF\xFE";
    public const BOM_UTF32_BE = "\x00\x00\xFE\xFF";
    public const BOM_UTF32_LE = "\xFF\xFE\x00\x00";
}
