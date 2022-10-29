<?php

namespace Marcelofabianov;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Marcelofabianov\Exception\FailDecryptException;

class Crypto
{
    private readonly string $value;
    private bool $encrypt;
    private StatusCode $defaultStatusCode;

    private function __construct(string $value, bool $encrypt, StatusCode|null $defaultStatusCode)
    {
        $this->value = $encrypt ? $this->encrypt($value) : $value;
        $this->defaultStatusCode = $defaultStatusCode ?? StatusCode::create(StatusCode::HTTP_BAD_REQUEST);
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
            throw new FailDecryptException($this->defaultStatusCode);
        }

        return $value;
    }

    public function isEncrypt(): bool
    {
        return $this->encrypt;
    }

    public static function create(string $value, bool $encrypt = true, StatusCode|null $defaultStatusCode = null): Crypto
    {
        return new Crypto($value, $encrypt, $defaultStatusCode);
    }
}
