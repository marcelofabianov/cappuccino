<?php

namespace Cappuccino;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Cappuccino\Exception\FailDecryptException;

class Crypto
{
    private readonly string $value;
    private bool $encrypt;

    private function __construct(string $value, bool $encrypt)
    {
        $this->value = $encrypt ? $this->encrypt($value) : $value;
    }

    public function get(): string
    {
        return $this->value;
    }

    private function encrypt(string $value): string
    {
        $this->encrypt = true;
        return Crypt::encrypt($value);
    }

    public function decrypt(): string
    {
        $this->encrypt = false;

        try {
            $value = Crypt::decryptString($this->value);
        } catch (DecryptException $e) {
            throw new FailDecryptException();
        }

        return $value;
    }

    public function isEncrypt(): bool
    {
        return $this->encrypt;
    }

    public static function create(string $value, bool $encrypt = true): Crypto
    {
        return new Crypto($value, $encrypt);
    }
}
