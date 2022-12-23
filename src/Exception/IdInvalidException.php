<?php

declare(strict_types=1);

namespace Cappuccino\Exception;

class IdInvalidException extends \ErrorException
{
    public function __construct(int $code = 500)
    {
        parent::__construct('ID does not follow the defined pattern', $code);
    }
}
