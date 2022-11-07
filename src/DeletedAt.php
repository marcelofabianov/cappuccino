<?php

namespace Cappuccino;

use Carbon\CarbonInterface;
use Carbon\Carbon;
use ErrorException;
use Cappuccino\Exception\DateInvalidFormatException;

class DeletedAt
{
    private readonly CarbonInterface|null $value;
    private static string $defaultDateFormat = 'Y-m-d H:i:s';

    private function __construct(string|null $value)
    {
        $defaultFormat = $_ENV['DEFAULT_DATE_FORMAT'] ?? self::$defaultDateFormat;
        $this->value = is_null($value) ? null : Carbon::createFromFormat($defaultFormat, $value);
    }

    public static function getDefaultDateFormat(): string
    {
        return self::$defaultDateFormat;
    }

    public function get(): Carbon|null
    {
        return $this->value;
    }

    public static function create(string|null $value): DeletedAt
    {
        if (!is_null($value)) {
            self::isValid($value);
        }

        return new DeletedAt($value);
    }

    public static function isValid(string $value): bool
    {
        $defaultFormat = $_ENV['DEFAULT_DATE_FORMAT'] ?? self::$defaultDateFormat;
        try {
            Carbon::createFromFormat($defaultFormat, $value);
        } catch (\ErrorException $e) {
            throw new DateInvalidFormatException('DeletedAt');
        }

        return true;
    }

    public function format(string|null $format = null): string|null
    {
        $date = null;
        if (!is_null($this->value)) {
            try {
                $defaultFormat = $_ENV['DEFAULT_DATE_FORMAT'] ?? self::$defaultDateFormat;
                $date = $this->value->format($format ?? $defaultFormat);
            } catch (ErrorException $e) {
                throw new DateInvalidFormatException('DeletedAt');
            }
        }
        return $date;
    }
}
