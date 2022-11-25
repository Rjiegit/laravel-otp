<?php

namespace Tests;

use Hellojie\LaravelOtp\OtpService;
use Illuminate\Foundation\Testing\RefreshDatabase;


class OtpTest extends TestCase
{
    use RefreshDatabase;

    public function test_should_generate_otp()
    {

        $otpService = new OtpService();
        $length = 5;
        $result = $otpService->generate(length: $length);

        $this->assertIsString($result);
        $this->assertEquals($length, strlen($result));
    }

    public function test_should_validate_the_otp()
    {


        $otpService = new OtpService();
        $result = $otpService->validate(key: 'key', token: 'token');

        $this->assertTrue($result);
    }

}
