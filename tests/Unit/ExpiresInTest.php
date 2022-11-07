<?php

use Cappuccino\ExpiresIn;
use Carbon\Carbon;

test('should return true when the date is in the past', function () {
    $yesterday = Carbon::yesterday();
    $expiresIn = ExpiresIn::create($yesterday->format('Y-m-d H:i:s'));
    expect($expiresIn->hasPassed())->toBeTrue();
});

test('should return true when the date is in the future', function () {
    $tomorrow = Carbon::tomorrow();
    $expiresIn = ExpiresIn::create($tomorrow->format('Y-m-d H:i:s'));
    expect($expiresIn->itIsFuture())->toBeTrue();
});
