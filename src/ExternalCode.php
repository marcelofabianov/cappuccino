<?php

declare(strict_types=1);

namespace Cappuccino;

use Cappuccino\Exception\ExternalCodeInvalidException;
use Ramsey\Uuid\Uuid;

class ExternalCode
{
    private readonly string|int $value;

    private function __construct(string|int|null $value)
    {
        if (! is_null($value) and ! self::isValid($value)) {
            throw new ExternalCodeInvalidException();
        }

        $this->value = $value ?? self::make();
    }

    public static function isValid(string|int $id): bool
    {
        if (Uuid::isValid($id)) {
            return true;
        }
        $id = (int) $id;

        return $id > 0;
    }

    public static function make(bool $int = false): string|int
    {
        if ($int) {
            return random_int(1, 100);
        }

        return (string) Uuid::uuid4();
    }

    public function get(): string|int
    {
        return $this->value;
    }

    public static function create(string|int|null $value = null): self
    {
        return new self($value);
    }
}
