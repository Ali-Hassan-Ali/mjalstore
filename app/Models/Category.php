<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Scopes\StatusScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasTranslations;

    protected $guarded = [];

    public array $translatable = ['name'];

    protected function imagePath(): Attribute
    {
        if(request()->segment(3) == 'categories' || $this->parent_id == '') {

            return Attribute::make(
                get: fn () => $this->logo ? asset('storage/' . $this->logo) : asset('admin_assets/images/default.png'),
            );

        } else {

            return Attribute::make(
                get: fn () => $this->banner ? asset('storage/' . $this->banner) : asset('admin_assets/images/default.png'),
            );
        }

    }//end of get ImagePath Attribute

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);

    }//end of admin

    //scope
    public function scopeCategory(Builder $query): Builder
    {
        return $query->whereNull('parent_id');

    }// end of scope Role

    public function scopeSubCategory(Builder $query): Builder
    {
        return $query->where('parent_id', '>' ,1);

    }// end of scope Role


    protected static function booted(): void
    {
        if(in_array(request()->segment(3), ['categories', 'sub_categories'])) {
           static::addGlobalScope(new StatusScope);
        }

    }//end of Global Scope

}//end of model
