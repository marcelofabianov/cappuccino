<?php

declare(strict_types=1);

namespace Cappuccino;

use stdClass;

class Json
{
    private readonly array|string $value;

    private function __construct(array|string $value)
    {
        $this->value = $value;
    }

    public function getValue(): array|string
    {
        return $this->value;
    }

    public function encode(): string|bool
    {
        if (is_array($this->value)) {
            return json_encode($this->value, JSON_THROW_ON_ERROR);
        }

        return false;
    }

    public function decode(): stdClass|array|bool
    {
        if (is_string($this->value)) {
            return json_decode($this->value, false, 512, JSON_THROW_ON_ERROR);
        }

        return false;
    }

    public static function create(array|string $value): self
    {
        return new self($value);
    }
}
