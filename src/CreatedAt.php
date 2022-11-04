<?php

namespace Cappuccino;

use Carbon\CarbonInterface;
use ErrorException;
use Carbon\Carbon;
use Cappuccino\Exception\DateInvalidFormatException;

class CreatedAt
{
    private readonly CarbonInterface $value;
    private static string $defaultDateFormat = 'Y-m-d H:i:s';

    private function __construct(string|null $value)
    {
        $this->value = is_null($value)
            ? Carbon::now()
            : Carbon::createFromFormat(getenv('DEFAULT_DATE_FORMAT', self::$defaultDateFormat), $value);
    }

    public static function getDefaultDateFormat(): string
    {
        return self::$defaultDateFormat;
    }

    public function get(): CarbonInterface
    {
        return $this->value;
    }

    public static function isValid(string $value): bool
    {
        try {
            Carbon::createFromFormat(getenv('DEFAULT_DATE_FORMAT', self::$defaultDateFormat), $value);
        } catch (ErrorException $e) {
            throw new DateInvalidFormatException('CreatedAt');
        }

        return true;
    }

    public static function create(string|null $value = null): CreatedAt
    {
        if (!is_null($value)) {
            self::isValid($value);
        }

        return new CreatedAt($value);
    }

    public function format(string|null $format = null): string
    {
        try {
            $date = $this->value->format(is_null($format) ?
                getenv('DEFAULT_DATE_FORMAT', self::$defaultDateFormat)
                : $format);
        } catch (ErrorException $e) {
            throw new DateInvalidFormatException('CreatedAt');
        }

        return $date;
    }
}
