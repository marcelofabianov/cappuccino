<?php

namespace Marcelofabianov;

use Marcelofabianov\Cnpj;
use Marcelofabianov\Cpf;
use Marcelofabianov\Exception\FailCreateRegistrationDocumentException;
use Marcelofabianov\Interfaces\IRegistrationDocument;

class RegistrationDocument
{
    private readonly IRegistrationDocument $value;

    private function __construct(IRegistrationDocument $value)
    {
        $this->value = $value;
    }

    public function numbers(): string
    {
        return $this->value->numbers();
    }

    public function format(): string
    {
        return $this->value->format();
    }

    public static function create(string $value): RegistrationDocument
    {
        if (Cnpj::isValid($value)) {
            return new RegistrationDocument(Cnpj::create($value));
        }
        if (Cpf::isValid($value)) {
            return new RegistrationDocument(Cpf::create($value));
        }

        throw new FailCreateRegistrationDocumentException(
            StatusCode::create(StatusCode::HTTP_BAD_REQUEST)
        );
    }
}
