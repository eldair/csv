<?php

declare(strict_types=1);

namespace Eldair\Csv;

use RuntimeException;

final class FragmentNotFound extends RuntimeException implements UnableToProcessCsv
{
}
