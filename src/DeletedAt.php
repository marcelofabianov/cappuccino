<?php

namespace Marcelofabianov;

use Carbon\CarbonInterface;
use Carbon\Carbon;
use ErrorException;
use Marcelofabianov\Exception\DateInvalidFormatException;

class DeletedAt
{
    private readonly CarbonInterface|null $value;
    private static string $defaultDateFormat = 'Y-m-d H:i:s';
    private static StatusCode $statusCode;

    private function __construct(string|null $value, StatusCode|null $defaultStatusCodeException)
    {
        $this->value = is_null($value)
            ? null
            : Carbon::createFromFormat(getenv('DEFAULT_DATE_FORMAT', self::$defaultDateFormat), $value);

        self::$statusCode = $defaultStatusCodeException ?? StatusCode::create(StatusCode::HTTP_BAD_REQUEST);
    }

    public static function getDefaultDateFormat(): string
    {
        return self::$defaultDateFormat;
    }

    public function get(): Carbon|null
    {
        return $this->value;
    }

    public static function create(string|null $value, StatusCode|null $defaultStatusCodeException = null): DeletedAt
    {
        if (!is_null($value)) {
            self::isValid($value);
        }

        return new DeletedAt($value);
    }

    public static function isValid(string $value): bool
    {
        try {
            Carbon::createFromFormat(getenv('DEFAULT_DATE_FORMAT', self::$defaultDateFormat), $value);
        } catch (\ErrorException $e) {
            throw new DateInvalidFormatException('DeletedAt', self::$statusCode);
        }

        return true;
    }

    public function format(string|null $format = null): string|null
    {
        $date = null;
        if (!is_null($this->value)) {
            try {
                $date = $this->value->format(is_null($format)
                    ? getenv('DEFAULT_DATE_FORMAT', self::$defaultDateFormat)
                    : $format);
            } catch (ErrorException $e) {
                throw new DateInvalidFormatException('DeletedAt', self::$statusCode);
            }
        }
        return $date;
    }
}
