<?php

use Cappuccino\ZipCode;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertTrue;

test('should create a zipcode with valid numbers and symbols', function () {
    $zipCode = ZipCode::create('50833-000');
    assertEquals('50833-000', $zipCode->format());
})->group('zipcode');

test('should create a valid zipcode with numbers only', function () {
    $zipCode = ZipCode::create('50833000');
    assertEquals('50833-000', $zipCode->format());
})->group('zipcode');

test('should create a valid zip code with numbers and symbols and return only numbers', function () {
    $zipCode = ZipCode::create('50833-000');
    assertEquals('50833000', $zipCode->numbers());
})->group('zipcode');

test('should create a zipcode with only number and return formatted', function () {
    $zipCode = ZipCode::create('50833000');
    assertEquals('50833-000', $zipCode->format());
})->group('zipcode');

test('random', function () {
    $zipCode = ZipCode::random();
    assertTrue(ZipCode::isValid($zipCode));
})->group('zipcode-random');
