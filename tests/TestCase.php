<?php

namespace Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom('./src/database/migrations');

        Factory::guessFactoryNamesUsing(
                fn (string $modelName) => 'Hellojie\\LaravelOtp\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }
}