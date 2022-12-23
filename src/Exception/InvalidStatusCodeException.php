<?php

declare(strict_types=1);

namespace Cappuccino\Exception;

class InvalidStatusCodeException extends \ErrorException
{
    public function __construct(int $code = 500)
    {
        parent::__construct('Invalid format StatusCode Http', $code);
    }
}
