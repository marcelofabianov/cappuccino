<?php

declare(strict_types=1);

namespace Cappuccino;

class Hostname
{
    private readonly string|bool $value;

    private function __construct(string|bool $value)
    {
        $this->value = $value;
    }

    public function get(): string|bool
    {
        return $this->value;
    }

    public static function capture(): self
    {
        return new self(gethostname());
    }
}
