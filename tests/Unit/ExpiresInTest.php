<?php

use Cappuccino\ExpiresIn;
use Carbon\Carbon;

test('should return true when the date is in the past', function () {
    $date1 = Carbon::now()->subSecond();
    $expiresIn = ExpiresIn::create($date1);
    expect($expiresIn->hasPassed())->toBeTrue();
});

test('should return true when the date is in the future', function () {
    $date1 = Carbon::now()->addSecond();
    $expiresIn = ExpiresIn::create($date1);
    expect($expiresIn->itIsFuture())->toBeTrue();
});
