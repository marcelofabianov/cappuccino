<?php

namespace Cappuccino;

class FederativeUnit
{
    private static array $cases = [
        'AC' => 'Acre',
        'AL' => 'Alagoas',
        'AP' => 'Amapá',
        'AM' => 'Amazonas',
        'BA' => 'Bahia',
        'CE' => 'Ceará',
        'DF' => 'Distrito Federal',
        'ES' => 'Espírito Santo',
        'GO' => 'Goiás',
        'MA' => 'Maranhão',
        'MT' => 'Mato Grosso',
        'MS' => 'Mato Grosso do Sul',
        'MG' => 'Minas Gerais',
        'PA' => 'Pará',
        'PB' => 'Paraíba',
    ];

    private string $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function isValid(string $value): bool
    {
        return array_key_exists($value, self::$cases);
    }

    public function initials(): string
    {
        return $this->value;
    }

    public function display(): string
    {
        return self::$cases[$this->value];
    }

    public static function create(string $value): self
    {
        if (!self::isValid($value)) {
            throw new \Exception('FederativeUnit invalid!');
        }

        return new FederativeUnit($value);
    }
}
