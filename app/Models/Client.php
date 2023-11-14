<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Client extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'client';

    protected $fillable = [
        'company_subscription_package', 'company_name', 'company_email',
        'company_phone', 'company_address', 'company_contact_person_name',
        'company_contact_person_email', 'otp_code', 'company_contact_person_phone',
        'password'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];
}
