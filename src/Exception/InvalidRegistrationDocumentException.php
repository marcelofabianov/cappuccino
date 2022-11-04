<?php

namespace Cappuccino\Exception;

use Cappuccino\Enum\RegistrationDocumentEnum;

class InvalidRegistrationDocumentException extends \ErrorException
{
    public function __construct(RegistrationDocumentEnum $type, int $code = 500)
    {
        parent::__construct($type->value.': invalid format', $code);
    }
}
