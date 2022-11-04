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
        $this->value = Carbon::createFromFormat(
            getenv('DEFAULT_DATE_FORMAT',
                self::$defaultDateFormat
            ), $value);
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
        try {
            Carbon::createFromFormat(getenv('DEFAULT_DATE_FORMAT', self::$defaultDateFormat), $value);
        } catch (\ErrorException $e) {
            throw new DateInvalidFormatException('ExpiresIn');
        }

        return true;
    }

    public function format(string|null $format = null): string
    {
        try {
            $date = $this->value->format(is_null($format)
                ? getenv('DEFAULT_DATE_FORMAT', self::$defaultDateFormat)
                : $format);
        } catch (ErrorException $e) {
            throw new DateInvalidFormatException('ExpiresIn');
        }

        return $date;
    }
}
