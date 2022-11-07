<?php

use Cappuccino\CreatedAt;
use Carbon\CarbonInterface;

test('must create an instance according to the given date', function () {
    $createdAt = CreatedAt::create('2022-02-01 23:45:10');
    expect($createdAt->get())->toBeInstanceOf(CarbonInterface::class);
});

test('must create an instance according to the current date', function () {
    $createdAt = CreatedAt::create();
    expect($createdAt->get())->toBeInstanceOf(CarbonInterface::class);
});

test('must format a date according to the format informed', function () {
    $createdAt = CreatedAt::create('2022-02-01 21:43:11');
    $format = 'd/m/Y H:i:s';
    expect($createdAt->format($format))->toBe('01/02/2022 21:43:11');
});

test('must format a date according to the standard format', function () {
    $createdAt = CreatedAt::create('2022-02-01 21:43:11');
    expect($createdAt->format())->toBe('2022-02-01 21:43:11');
});
