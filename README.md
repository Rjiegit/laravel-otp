# Laravel Otp

---

## Introduction
A simple OTP package for laravel 9.

## Installation
```
composer require hellojie/laravel-otp:dev-main
```

## Publish the migrations
```php
php artisan vendor:publish
```

## Usage

### Generate OTP
```php
<?php
use Hellojie\LaravelOtp\OtpService;

/** @var OtpService $otpService */
$otpService = app(OtpService::class);
$token = $otpService->generate('test-key');

```


### Validate OTP
```php
<?php

use Hellojie\LaravelOtp\OtpService;

/** @var OtpService $otpService */
$otpService = app(OtpService::class);
$isValid = $otpService->validate('test-key', 'test-token');
```