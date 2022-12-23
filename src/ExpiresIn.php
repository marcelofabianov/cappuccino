<?php

declare(strict_types=1);

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

    public static function create(string $value): self
    {
        self::isValid($value);

        return new self($value);
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

    private function diff(CarbonInterface $compare, $measure = 'seconds'): int
    {
        return match ($measure) {
            'hours' => $compare->diffInHours($this->value, false),
            'days' => $compare->diffInDays($this->value, false),
            'minutes' => $compare->diffInMinutes($this->value, false),
            default => $compare->diffInSeconds($this->value, false),
        };
    }

    public function hasPassed(CarbonInterface|null $compare = null, $measure = 'seconds'): bool
    {
        $compare = $compare ?? Carbon::now();
        $diff = $this->diff($compare, $measure);

        return $diff < 0;
    }

    public function itIsFuture(CarbonInterface|null $compare = null, $measure = 'seconds'): bool
    {
        $compare = $compare ?? Carbon::now();
        $diff = $this->diff($compare, $measure);

        return $diff >= 0;
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
