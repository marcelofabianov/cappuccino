<?php

namespace Marcelofabianov;

use Carbon\CarbonInterface;
use ErrorException;
use Carbon\Carbon;
use Marcelofabianov\Exception\DateInvalidFormatException;

class CreatedAt
{
    private readonly CarbonInterface $value;
    private static string $defaultDateFormat = 'Y-m-d H:i:s';
    private static StatusCode $statusCode;

    private function __construct(string|null $value, StatusCode|null $defaultStatusCodeException)
    {
        $this->value = is_null($value)
            ? Carbon::now()
            : Carbon::createFromFormat(getenv('DEFAULT_DATE_FORMAT', self::$defaultDateFormat), $value);

        self::$statusCode = $defaultStatusCodeException ?? StatusCode::create(StatusCode::HTTP_BAD_REQUEST);
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
            throw new DateInvalidFormatException('CreatedAt', self::$statusCode);
        }

        return true;
    }

    public static function create(string|null $value = null, StatusCode|null $defaultStatusCodeException = null): CreatedAt
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
            throw new DateInvalidFormatException('CreatedAt', self::$statusCode);
        }

        return $date;
    }
}
