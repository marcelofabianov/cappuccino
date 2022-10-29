<?php

namespace Marcelofabianov\Exception;

use Marcelofabianov\StatusCode;

class FailDecryptException extends \ErrorException
{
    public function __construct(StatusCode $statusCode)
    {
        parent::__construct('Fail decrypt exception', $statusCode->code());
    }
}
