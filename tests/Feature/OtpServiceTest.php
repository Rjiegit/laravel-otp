<?php

namespace Hellojie\LaravelOtp\Tests\Feature;

use Hellojie\LaravelOtp\Tests\TestCase;
use Hellojie\LaravelOtp\Models\Otp;
use Hellojie\LaravelOtp\OtpService;
use Illuminate\Foundation\Testing\RefreshDatabase;


class OtpServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testShouldGenerateOtp()
    {
        $key = 'thiskey';
        $length = 5;

        $otpService = $this->createOtpService();

        $result = $otpService->generate(key: $key, length: $length);

        $this->assertIsString($result);
        $this->assertEquals($length, strlen($result));

        $this->assertDatabaseHas((new Otp())->getTable(), [
                'key' => $key,
                'token' => $result,
        ]);
    }

    public function testShouldValidateTheOtp()
    {
        $otp = Otp::factory()->create();

        $otpService = $this->createOtpService();
        $result = $otpService->validate(key: $otp->key, token: $otp->token);

        $this->assertTrue($result);
    }

    public function testShouldReturnFalseIfOtpNotExists()
    {
        $otpService = $this->createOtpService();

        $result = $otpService->validate(key: 'xxx', token: 'xxx');

        $this->assertFalse($result);
    }

    public function testShouldReturnFalseIfOtpIsExpired()
    {
        $otp = Otp::factory()->create([
                'expired_at' => now()->subSecond()
        ]);

        $otpService = $this->createOtpService();

        $result = $otpService->validate(key: $otp->key, token: $otp->token);

        $this->assertFalse($result);
    }

    public function testShouldReturnTrueIfOtpIsValid()
    {
        $otp = Otp::factory()->create([
                'expired_at' => now()->addMinute()
        ]);

        $otpService = $this->createOtpService();

        $result = $otpService->validate(key: $otp->key, token: $otp->token);

        $this->assertTrue($result);
    }

    public function testShouldMarkUsedAtIfOtpValidated()
    {
        $otp = Otp::factory()->create();

        $otpService = $this->createOtpService();

        $result = $otpService->validate(key: $otp->key, token: $otp->token);

        $this->assertTrue($result);
        $this->assertDatabaseMissing((new Otp())->getTable(), [
                'key' => $otp->key,
                'token' => $otp->token,
                'used_at' => null
        ]);
    }

    public function testShouldReturnFalseIfOtpValidatedAgain()
    {
        $otp = Otp::factory()->create();

        $otpService = $this->createOtpService();

        $otpService->validate(key: $otp->key, token: $otp->token);
        $result = $otpService->validate(key: $otp->key, token: $otp->token);

        $this->assertFalse($result);
    }

    public function createOtpService(): OtpService
    {
        return app(OtpService::class);
    }

}
