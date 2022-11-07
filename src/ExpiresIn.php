<?php

namespace Cappuccino;

use Cappuccino\Exception\DateInvalidFormatException;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use ErrorException;

class ExpiresIn
{
    private readonly CarbonInterface $value;
    private static string $defaultDateFormat = 'Y-m-d H:i:s';

    private function __construct(string $value)
    {
        $defaultFormat = $_ENV['DEFAULT_DATE_FORMAT'] ?? self::$defaultDateFormat;
        $this->value = Carbon::createFromFormat($defaultFormat, $value);
    }

    public function get(): CarbonInterface
    {
        return $this->value;
    }

    public static function create(string $value): ExpiresIn
    {
        self::isValid($value);

        return new ExpiresIn($value);
    }

    public static function isValid(string $value): bool
    {
        $defaultFormat = $_ENV['DEFAULT_DATE_FORMAT'] ?? self::$defaultDateFormat;

        try {
            Carbon::createFromFormat($defaultFormat, $value);
        } catch (\ErrorException $e) {
            throw new DateInvalidFormatException('ExpiresIn');
        }

        return true;
    }

    private function diff(CarbonInterface $before, $measure = 'minutes'): int
    {
        return match ($measure) {
            'hours' => $before->diffInHours($this->value, false),
            'days' => $before->diffInDays($this->value, false),
            default => $before->diffInMinutes($this->value, false),
        };
    }

    public function hasPassed($measure = 'minutes'): bool
    {
        $now = Carbon::now();
        $diff = $this->diff($now, $measure);
        return $diff < 0;
    }

    public function itIsFuture($measure = 'minutes'): bool
    {
        $now = Carbon::now();
        $diff = $this->diff($now, $measure);
        return $diff > 0;
    }

    public function format(string|null $format = null): string
    {
        $defaultFormat = $_ENV['DEFAULT_DATE_FORMAT'] ?? self::$defaultDateFormat;

        try {
            $date = $this->value->format($format ?? $defaultFormat);
        } catch (ErrorException $e) {
            throw new DateInvalidFormatException('ExpiresIn');
        }

        return $date;
    }
}
