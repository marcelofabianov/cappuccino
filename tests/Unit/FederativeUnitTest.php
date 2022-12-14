<?php

use Cappuccino\FederativeUnit;
use function PHPUnit\Framework\assertTrue;

test('should create a valid federative unit and present a defined option', function () {
    $federativeUnit = FederativeUnit::create('MG');
    assertTrue($federativeUnit->display() === 'Minas Gerais');
})->group('federativeUnit');

test('should return true when the abbreviation corresponds to a valid federative unit', function () {

    expect(FederativeUnit::isValid('GO'))->toBeTrue();

})->group('federativeUnit');

test('should return true when the abbreviation returned is from an existing federative unit', function () {
    $federativeUnit = FederativeUnit::create('MG');

    expect($federativeUnit->initials())->toEqual('MG');
})->group('federativeUnit');
