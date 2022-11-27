# Laravel Otp

[![Latest Stable Version](http://poser.pugx.org/hellojie/laravel-otp/v)](https://packagist.org/packages/hellojie/laravel-otp) [![Total Downloads](http://poser.pugx.org/hellojie/laravel-otp/downloads)](https://packagist.org/packages/hellojie/laravel-otp) [![Latest Unstable Version](http://poser.pugx.org/hellojie/laravel-otp/v/unstable)](https://packagist.org/packages/hellojie/laravel-otp) [![License](http://poser.pugx.org/hellojie/laravel-otp/license)](https://packagist.org/packages/hellojie/laravel-otp) [![PHP Version Require](http://poser.pugx.org/hellojie/laravel-otp/require/php)](https://packagist.org/packages/hellojie/laravel-otp)

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