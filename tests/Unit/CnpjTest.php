<?php

use Cappuccino\Cnpj;

it('should validate the CNPJ format as true', function () {
    expect(Cnpj::isValidFormat('63.836.040/0001-34'))
        ->toBeTrue();
});

it('should validate the CNPJ format as false', function () {
    expect(Cnpj::isValidFormat('00.000.000/0000/00'))
        ->toBeFalse()
        ->and(Cnpj::isValidFormat('00000000000000'))
        ->toBeFalse();
});

it('should return only numbers', function () {
    $cnpj = new Cnpj('29.281.372/0001-90');
    expect($cnpj)->toEqual('29281372000190');
});

it('should return formatted CNPJ', function () {
    $cnpj = new Cnpj('39599026000196');
    expect('39.599.026/0001-96')->toEqual($cnpj->getFormat());
});

it('should return false when the CNPJ is not valid', function () {
    expect(Cnpj::isValid('11.444.777/0001-62'))
        ->toBeFalse();
});

it('should return true when the CNPJ is valid', function () {
    expect(Cnpj::isValid('11.444.777/0001-61'))
        ->toBeTrue();
});

it('should return false when CNPJ has more than 14 digits', function () {
    expect(Cnpj::isValid('11.444.777/0001-543'))
        ->toBeFalse();
});

it('should return false when the number of digits in the CNPJ is less than 14.', function () {
    expect(Cnpj::isValid('11.444.777/001-54'))
        ->toBeFalse();
});

it('should return false when CNPJ starts with 00', function () {
    expect(Cnpj::isValid('00.000.000/0000-00'))
        ->toBeFalse();
});

it('should generate a valid CNPJ', function () {
    $cnpj = Cnpj::random();

    expect(Cnpj::isValid($cnpj))
        ->toBeTrue();
});
