<?php

declare(strict_types=1);

namespace Cappuccino\Enum;

enum RegistrationDocumentEnum: string
{
    case CPF = 'CPF';
    case CNPJ = 'CNPJ';
    case IE = 'IE';
}
