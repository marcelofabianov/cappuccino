<?php

namespace Marcelofabianov\Exception;

use Marcelofabianov\StatusCode;

class FailCreateRegistrationDocumentException extends \ErrorException
{
    public function __construct(StatusCode $statusCode)
    {
        parent::__construct('Fail create registration document', $statusCode->code());
    }
}
