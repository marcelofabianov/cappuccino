<?php

use Cappuccino\IpAddress;

test('should return true when the ip entered is valid', function () {
    expect(IpAddress::isValid('255.255.255.255'))->toBeTrue();
});

test('should return true when generating a valid random ip', function () {
    $ip = IpAddress::make();
    expect(IpAddress::isValid($ip))->toBeTrue();
});
