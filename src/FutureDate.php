<?php

namespace Cappuccino;

use Cappuccino\Exception\DateInvalidFormatException;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use ErrorException;

class FutureDate
{
    private readonly CarbonInterface $value;
    private static string $defaultDateFormat = 'Y-m-d H:i:s';

    private function __construct()
    {
        $this->value = Carbon::now();
    }

    public function get(): CarbonInterface
    {
        return $this->value;
    }

    public function format(string $format = null): string
    {
        $defaultFormat = $_ENV['DEFAULT_DATE_FORMAT'] ?? self::$defaultDateFormat;

        try {
            $date = $this->value->format($format ?? $defaultFormat);
        } catch (ErrorException $e) {
            throw new DateInvalidFormatException('ExpiresIn');
        }

        return $date;
    }

    public function now(): self
    {
        $this->value->now();
        return $this;
    }

    public function addHour(): self
    {
        return $this->addHours(1);
    }

    public function addHours(int $value): self
    {
        $this->value->now()->addHours($value);
        return $this;
    }

    public function addMinute(): self
    {
        return $this->addMinutes(1);
    }

    public function addMinutes(int $value): self
    {
        $this->value->now()->addMinutes($value);
        return $this;
    }

    public function addDay(): self
    {
        return $this->addDays(1);
    }

    public function addDays(int $value): self
    {
        $this->value->now()->addDays($value);
        return $this;
    }

    public static function create(): self
    {
        return new self();
    }
}
