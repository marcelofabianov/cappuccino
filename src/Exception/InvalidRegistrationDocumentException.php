<?php

namespace Marcelofabianov\Exception;

use Marcelofabianov\Enum\RegistrationDocumentEnum;
use Marcelofabianov\StatusCode;

class InvalidRegistrationDocumentException extends \ErrorException
{
    public function __construct(RegistrationDocumentEnum $type, StatusCode $statusCode)
    {
        parent::__construct($type->value.': invalid format', $statusCode->code());
    }
}
