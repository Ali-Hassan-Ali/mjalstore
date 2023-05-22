<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasFactory;
    use HasRoles;

    protected $fillable = ['name','email','password'];

    protected $hidden   = ['password'];

    protected function imagePath(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->image == 'default.png' ? 
            asset('admin_assets/images/default.png') : Storage::url('uploads/' . $this->image),
        );

    }//end of get ImagePath Attribute

}//end of model