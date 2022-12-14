<?php

namespace Hellojie\LaravelOtp\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{

    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'otps';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'key',
            'token',
            'used_at',
            'expired_at',
    ];

    protected $casts = [
            'expired_at' => 'datetime',
            'used_at' => 'datetime',
    ];

}