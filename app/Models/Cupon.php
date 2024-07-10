<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Scopes\StatusScope;

class Cupon extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts   = ['start_date' => 'date', 'end_date' => 'date'];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);

    }//end of admin

    protected static function booted(): void
    {
        if(!request()->is('*cupons*')) {
           static::addGlobalScope(new StatusScope);
        }

    }//end of Global Scope

}//end of model