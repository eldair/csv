<?php

namespace Eldair\Csv;

use Deprecated;

/**
 * Defines constants for common BOM sequences.
 *
 * @deprecated since version 9.16.0
 * @see Bom
 */
interface ByteSequence
{
    #[Deprecated(message: 'use Eldair\Csv\Bom:Utf8 instead', since: 'league/csv:9.16.0')]
    public const BOM_UTF8 = "\xEF\xBB\xBF";
    #[Deprecated(message: 'use Eldair\Csv\Bom:Utf16be instead', since: 'league/csv:9.16.0')]
    public const BOM_UTF16_BE = "\xFE\xFF";
    #[Deprecated(message: 'use Eldair\Csv\Bom:Utf16Le instead', since: 'league/csv:9.16.0')]
    public const BOM_UTF16_LE = "\xFF\xFE";
    #[Deprecated(message: 'use Eldair\Csv\Bom:Utf32Be instead', since: 'league/csv:9.16.0')]
    public const BOM_UTF32_BE = "\x00\x00\xFE\xFF";
    #[Deprecated(message: 'use Eldair\Csv\Bom:Utf32Le instead', since: 'league/csv:9.16.0')]
    public const BOM_UTF32_LE = "\xFF\xFE\x00\x00";
}
