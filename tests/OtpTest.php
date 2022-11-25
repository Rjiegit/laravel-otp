<?php

namespace Tests;

use Hellojie\LaravelOtp\Otp;
use PHPUnit\Framework\TestCase;

class OtpTest extends TestCase
{
    public function test_should_generate_otp()
    {
        $otp = new Otp();
        $length = 5;
        $result = $otp->generate(length: $length);

        $this->assertIsString($result);
        $this->assertEquals($length, strlen($result));
    }
}
