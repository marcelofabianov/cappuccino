<?php

namespace Marcelofabianov\Enum;

enum RegistrationDocumentEnum: string
{
    case CPF = 'CPF';
    case CNPJ = 'CNPJ';
    case IE = 'IE';
}
