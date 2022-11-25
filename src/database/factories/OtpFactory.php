<?php

namespace Hellojie\LaravelOtp\Database\Factories;

use Hellojie\LaravelOtp\Models\Otp;
use Illuminate\Database\Eloquent\Factories\Factory;

class OtpFactory extends Factory
{

    protected $model = Otp::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'key' => $this->faker->unique()->title,
            'token' => $this->faker->title
        ];
    }
}
