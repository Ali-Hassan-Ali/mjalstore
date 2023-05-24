<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\Scopes\StatusScope;

class Language extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected function imagePath(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->flag ? asset('storage/' . $this->flag) : asset('admin_assets/images/default.png'),
        );

    }//end of get ImagePath Attribute

    protected static function booted(): void
    {
        if(!request()->is('*languages*')) {
           static::addGlobalScope(new StatusScope);
        }

    }//end of Global Scope

}//end of model
