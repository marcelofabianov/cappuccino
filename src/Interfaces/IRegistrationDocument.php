<?php

namespace Marcelofabianov\Interfaces;

use Marcelofabianov\Enum\RegistrationDocumentEnum;

interface IRegistrationDocument
{
    public function numbers(): string;

    public function format(): string;

    public static function type(): RegistrationDocumentEnum;
}
