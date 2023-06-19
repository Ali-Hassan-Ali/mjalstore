<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Scopes\StatusScope;

class Currency extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasTranslations;

    protected $guarded = [];

    public array $translatable = ['name'];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);

    }//end of admin

    public function currencyPrice(): HasOne
    {
        return $this->hasOne(CurrencyPrice::class)->latest();

    }//end of admin

    protected static function booted(): void
    {
        if(!request()->is('*currencies*')) {
           static::addGlobalScope(new StatusScope);
        }

    }//end of Global Scope

}//end of model