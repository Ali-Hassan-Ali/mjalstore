<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Scopes\StatusScope;

class Card extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected function newPrice(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->price,
            // get: fn () => session('currency_code') == getCurrency('default')?->code ? $this->price : (number_format($this->price * session('currency'), 2)),
        );

    }//end of get new price Attribute

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);

    }//end of admin

    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');

    }//end of sub Category

    public function market(): BelongsTo
    {
        return $this->belongsTo(Market::class);

    }//end of market

    protected static function booted(): void
    {
        if(!request()->is('*cards*')) {
           static::addGlobalScope(new StatusScope);
        }

    }//end of Global Scope

}//end of model