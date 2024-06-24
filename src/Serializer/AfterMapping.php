<?php

declare(strict_types=1);

namespace Eldair\Csv\Serializer;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
final class AfterMapping
{
    /** @var array<string> $methods */
    public readonly array $methods;

    public function __construct(string ...$methods)
    {
        $this->methods = $methods;
    }
}
