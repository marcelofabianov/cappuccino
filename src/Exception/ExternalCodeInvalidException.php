<?php

declare(strict_types=1);

namespace Cappuccino\Exception;

class ExternalCodeInvalidException extends \ErrorException
{
    public function __construct(int $code = 500)
    {
        parent::__construct('External code invalid', $code);
    }
}
