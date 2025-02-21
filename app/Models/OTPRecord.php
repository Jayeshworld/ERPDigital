<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OTPRecord extends Model
{
    use HasFactory;
    protected $table = 'otpRequest';
    protected $fillable = [
        'mobile_number',
        'otp',
        'requested_at',
        'expires_at',
        'status',

    ];
}