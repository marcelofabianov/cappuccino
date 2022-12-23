<?php

declare(strict_types=1);

namespace Cappuccino;

use Illuminate\Support\Facades\Hash as HashMake;

class Hash
{
    private readonly string $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public function get(): string
    {
        return $this->value;
    }

    public static function make(string $value): self
    {
        return new self(HashMake::make($value));
    }

    public static function check(string $value, string $hash): bool
    {
        return HashMake::check($value, $hash);
    }
}
