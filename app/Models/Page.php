<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Scopes\StatusScope;

class Page extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasTranslations;

    protected $guarded = [];

    public array $translatable = ['title', 'description_one', 'description_tow'];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);

    }//end of admin

    protected static function booted(): void
    {
        if(!request()->is('*pages*')) {
           static::addGlobalScope(new StatusScope);
        }

    }//end of Global Scope

}//end of Model