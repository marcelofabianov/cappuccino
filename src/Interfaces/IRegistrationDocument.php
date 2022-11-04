<?php

namespace Cappuccino\Interfaces;

use Cappuccino\Enum\RegistrationDocumentEnum;

interface IRegistrationDocument
{
    public function numbers(): string;

    public function format(): string;

    public static function type(): RegistrationDocumentEnum;
}
