<?php


use Cappuccino\Cpf;

it('should validate the CPF format as true', function () {
    expect(Cpf::isValidFormat('111.222.333-44'))
        ->toBeTrue();
});

it('should validate the CPF format as false', function () {
    expect(Cpf::isValidFormat('00.000.000/0000/00'))
        ->toBeFalse()
        ->and(Cpf::isValidFormat('00000000000000'))
        ->toBeFalse();
});

it('should return only numbers', function () {
    $cpf = new Cpf('111.222.333-44');
    expect($cpf)->toEqual('11122233344');
});

it('should return formatted CPF', function () {
    $cpf = new Cpf('11122233344');
    expect('111.222.333-44')->toEqual($cpf->getFormat());
});

it('should return false when the CPF is not valid', function () {
    expect(Cpf::isValid('111.222.333-99'))
        ->toBeFalse();
});

it('should return true when the CPF is valid', function () {
    expect(Cpf::isValid('111.222.333-88'))
        ->toBeTrue();
});

it('should return false when CPF has more than 11 digits', function () {
    expect(Cpf::isValid('111.222.333-455'))
        ->toBeFalse();
});

it('should return false when the number of digits in the CPF is less than 11', function () {
    expect(Cpf::isValid('111.222.333-4'))
        ->toBeFalse();
});

it('should return false when the CPF starts with 3 consecutive zeros', function () {
    expect(Cpf::isValid('000.000.000-00'))
        ->toBeFalse();
});

it('should generate a valid CPF', function () {
    $cpf = Cpf::random();
    expect(Cpf::isValid($cpf))->toBeTrue();
});

