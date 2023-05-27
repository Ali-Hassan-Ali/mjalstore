<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Market extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasTranslations;

    protected $guarded = [];

    public array $translatable = ['name'];

    protected function imagePath(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->flag ? asset('storage/' . $this->flag) : asset('admin_assets/images/default.png'),
        );

    }//end of get ImagePath Attribute

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);

    }//end of admin

    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');

    }//end of subCategory

    public function products(): HasMany
    {
        return $this->hasMany(Admin::class);

    }//end of products

}//end of model