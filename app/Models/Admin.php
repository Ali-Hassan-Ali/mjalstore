<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasFactory;
    use HasRoles;

    protected $fillable = ['name','email','password', 'status', 'image'];

    protected $hidden   = ['password', 'remember_token'];

    protected function imagePath(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->image != 'default.png' ? asset('storage/' . $this->image) : asset('admin_assets/images/default.png'),
        );

    }//end of get ImagePath Attribute

    //scope
    public function scopeRoleNot(Builder $query, $rolesName = []): Builder
    {
        return $query->when($rolesName, fn ($query) => $query->whereHas('roles', fn ($query) => $query->whereNotIn('name', $rolesName)));

    }// end of scope Role

}//end of model