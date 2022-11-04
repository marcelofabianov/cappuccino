<?php

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

    public static function make(string $value): Hash
    {
        return new Hash(HashMake::make($value));
    }

    public static function check(string $value, string $hash): bool
    {
        return HashMake::check($value, $hash);
    }
}
