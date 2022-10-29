<?php

namespace Marcelofabianov\Exception;

use Marcelofabianov\StatusCode;

class DateInvalidFormatException extends \ErrorException
{
    public function __construct(string $dateFieldName, StatusCode|null $statusCode = null)
    {
        $statusCode = $statusCode ?? StatusCode::create(StatusCode::HTTP_BAD_REQUEST);

        parent::__construct($dateFieldName.": The date does not follow the defined format", $statusCode->code());
    }
}
