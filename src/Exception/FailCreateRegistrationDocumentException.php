<?php

declare(strict_types=1);

namespace Cappuccino\Exception;

class FailCreateRegistrationDocumentException extends \ErrorException
{
    public function __construct(int $code = 500)
    {
        parent::__construct('Fail create registration document', $code);
    }
}
