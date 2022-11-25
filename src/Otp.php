<?php

namespace Hellojie\LaravelOtp;

class Otp
{

    public function __construct()
    {
    }

    public function generate(int $length = 5)
    {
        return str_pad(
                (string)rand(0, pow(10, $length) - 1),
                $length,
                '0',
                STR_PAD_LEFT
        );
    }

}