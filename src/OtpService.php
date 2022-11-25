<?php

namespace Hellojie\LaravelOtp;

use Hellojie\LaravelOtp\Models\Otp;

class OtpService
{

    public function __construct()
    {
    }

    public function generate(string $key, int $length = 5, int $timeSeconds = 60): string
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
                'expired_at' => now()->addSeconds($timeSeconds)
        ]);

        return $token;
    }

    public function validate(
            string $key,
            string $token
    ): bool {
        $otp = Otp::query()
                ->where('key', $key)
                ->where('token', $token)
                ->first();

        if ($otp === null) {
            return false;
        }

        if (now()->isAfter($otp->expired_at)) {
            return false;
        }

        return true;
    }

}