<?php

use Cappuccino\Cnpj;

test('must validate invalid cnpj as false', function () {
    $result = Cnpj::isValid('30225497000101');
    expect($result)->toBeFalse();
});

test('must validate a valid cnpj as true', function () {
    $result = Cnpj::isValid('30225497000107');
    expect($result)->toBeTrue();
});

test('must create an instance from a numeric CNPJ', function () {
    $cnpj = Cnpj::create('30225497000107');
    expect($cnpj->numbers())->toBe('30225497000107');
});

test('must create an instance of a formatted cnpj', function () {
    $cnpj = Cnpj::create('30.225.497/0001-07');
    expect($cnpj->format())->toBe('30.225.497/0001-07');
});

test('must create a cnpj through a formatted cnpj and get a numeric cnpj', function () {
    $cnpj = Cnpj::create('30.225.497/0001-07');
    expect($cnpj->numbers())->toBe('30225497000107');
});

test('should create a numeric cnpj instance and get a formatted cnpj', function () {
    $cnpj = Cnpj::create('30225497000107');
    expect($cnpj->format())->toBe('30.225.497/0001-07');
});
