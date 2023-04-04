<?php

declare(strict_types=1);

namespace Eldair\Csv;

use Exception as PhpException;

/**
 * League Csv Base Exception.
 */
class Exception extends PhpException implements UnableToProcessCsv
{
}
