<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name', 'username', 'email', 'email_verified_at',
                            'password', 'image', 'phone', 'phone_code', 'country_code',
                            'phone_verified_at', 'country_name', 'provider', 'provider_id'];

    protected $hidden   = ['password','remember_token'];

    protected $casts    = ['email_verified_at' => 'datetime', 'phone_verified_at' => 'datetime'];

    protected function imagePath(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->image != 'default.png' ? asset('storage/' . $this->image) : asset('admin_assets/images/default.png'),
        );

    }//end of get ImagePath Attribute

    protected function FullPhone(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->phone_code . $this->phone,
        );

    }//end of get FullPhone Attribute

}//end of model