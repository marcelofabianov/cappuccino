<?php

namespace Cappuccino\Exception;

class InvalidIpAddress extends \ErrorException
{
    public function __construct(int $code = 500)
    {
        parent::__construct('Invalid Ip Address', $code);
    }
}
