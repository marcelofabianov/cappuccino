<?php

declare(strict_types=1);

namespace Cappuccino\Exception;

class DateInvalidFormatException extends \ErrorException
{
    public function __construct(string $dateFieldName, int $code = 500)
    {
        parent::__construct($dateFieldName.': The date does not follow the defined format', $code);
    }
}
