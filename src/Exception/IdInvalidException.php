<?php

namespace Cappuccino\Exception;

class IdInvalidException extends \ErrorException
{
    public function __construct(int $code = 500)
    {
        parent::__construct('ID does not follow the defined pattern', $code);
    }
}
