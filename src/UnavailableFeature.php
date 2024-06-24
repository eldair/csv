<?php

declare(strict_types=1);

namespace Eldair\Csv;

use Throwable;

/**
 * StreamFilterSupportMissing Exception.
 */
class UnavailableFeature extends Exception
{
    /**
     * DEPRECATION WARNING! This class will be removed in the next major point release.
     *
     * @deprecated since version 9.7.0
     */
    public function __construct(string $message = '', int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function dueToUnsupportedStreamFilterApi(string $className): self
    {
        return new self('The stream filter API can not be used with a '.$className.' instance.');
    }

    public static function dueToMissingStreamSeekability(): self
    {
        return new self('stream does not support seeking.');
    }
}
