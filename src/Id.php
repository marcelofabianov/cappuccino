<?php

declare(strict_types=1);

namespace Cappuccino;

use Cappuccino\Exception\IdInvalidException;
use Ramsey\Uuid\Uuid;

class Id
{
    private readonly string $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function isValid(string $id): bool
    {
        return Uuid::isValid($id);
    }

    public static function make(): string
    {
        return (string) Uuid::uuid4();
    }

    public function get(): string
    {
        return $this->value;
    }

    public static function create(string|null $value = null): self
    {
        if (is_null($value)) {
            $value = self::make();
        }

        if (! self::isValid($value)) {
            throw new IdInvalidException();
        }

        return new self($value);
    }
}
