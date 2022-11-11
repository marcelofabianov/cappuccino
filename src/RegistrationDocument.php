<?php

namespace Cappuccino;

use Cappuccino\Enum\RegistrationDocumentEnum;
use Cappuccino\Exception\FailCreateRegistrationDocumentException;
use Cappuccino\Interfaces\IRegistrationDocument;

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

    public function type(): RegistrationDocumentEnum
    {
        return $this->value::type();
    }

    public function random(): IRegistrationDocument
    {
        return $this->value::random();
    }

    public static function create(string $value): RegistrationDocument
    {
        if (Cnpj::isValid($value)) {
            return new RegistrationDocument(Cnpj::create($value));
        }
        if (Cpf::isValid($value)) {
            return new RegistrationDocument(Cpf::create($value));
        }

        throw new FailCreateRegistrationDocumentException();
    }
}
