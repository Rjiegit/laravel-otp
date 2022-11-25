<?php

namespace Hellojie\LaravelOtp;

use Hellojie\LaravelOtp\Models\Otp;

class OtpService
{

    public function __construct()
    {
    }

    public function generate(string $key, int $length = 5): string
    {
        $token = str_pad(
                (string)rand(0, pow(10, $length) - 1),
                $length,
                '0',
                STR_PAD_LEFT
        );

        Otp::create([
                'key' => $key,
                'token' => $token,
        ]);

        return $token;
    }

    public function validate(
            string $key,
            string $token
    ): bool {
        return Otp::query()
                ->where('key', $key)
                ->where('token', $token)
                ->exists();
    }

}