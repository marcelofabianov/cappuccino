<?php

namespace Cappuccino\Exception;

class FailDecryptException extends \ErrorException
{
    public function __construct(int $code = 500)
    {
        parent::__construct('Fail decrypt exception', $code);
    }
}
