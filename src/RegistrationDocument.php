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

    public static function random(RegistrationDocumentEnum $type): self
    {
        if ($type === RegistrationDocumentEnum::CPF) {
            return new self(Cpf::random());
        }
        if ($type === RegistrationDocumentEnum::CNPJ) {
            return new self(Cnpj::random());
        }

        throw new FailCreateRegistrationDocumentException();
    }

    public static function valid(string $value): bool
    {
        if (Cnpj::isValid($value) or Cpf::isValid($value)) {
            return true;
        }
        return false;
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
