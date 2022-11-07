<?php

namespace Cappuccino;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Cappuccino\Exception\DateInvalidFormatException;
use ErrorException;

class UpdatedAt
{
    private readonly CarbonInterface $value;
    private static string $defaultDateFormat = 'Y-m-d H:i:s';

    private function __construct(string|null $value)
    {
        $defaultFormat = $_ENV['DEFAULT_DATE_FORMAT'] ?? self::$defaultDateFormat;
        $this->value = is_null($value) ? Carbon::now() : Carbon::createFromFormat($defaultFormat, $value);
    }

    public static function getDefaultDateFormat(): string
    {
        return self::$defaultDateFormat;
    }

    public function get(): CarbonInterface
    {
        return $this->value;
    }

    public static function create(string|null $value = null): UpdatedAt
    {
        if (!is_null($value)) {
            self::isValid($value);
        }

        return new UpdatedAt($value);
    }

    public static function isValid(string $value): bool
    {
        $defaultFormat = $_ENV['DEFAULT_DATE_FORMAT'] ?? self::$defaultDateFormat;

        try {
            Carbon::createFromFormat($defaultFormat, $value);
        } catch (ErrorException $e) {
            throw new DateInvalidFormatException('UpdatedAt');
        }

        return true;
    }

    public function format(string|null $format = null): string
    {
        $defaultFormat = $_ENV['DEFAULT_DATE_FORMAT'] ?? self::$defaultDateFormat;

        try {
            $date = $this->value->format($format ?? $defaultFormat);
        } catch (ErrorException $e) {
            throw new DateInvalidFormatException('UpdatedAt');
        }

        return $date;
    }
}
