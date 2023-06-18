<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Scopes\StatusScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasTranslations;

    protected $guarded = [];
    protected $casts   = ['parent_id' => 'integer'];

    public array $translatable = ['name', 'title_card', 'description'];

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

    public function categoryRelation(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');

    }//end of category

    public function subCategoriesRelation(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');

    }//end of subCategories

    public function cards(): HasMany
    {
        return $this->hasMany(Card::class);

    }//end of cards

    public function markets(): BelongsToMany
    {
        return $this->belongsToMany(Market::class, 'category_markets');

    }//end of markets

    //scope
    public function scopeCategory(Builder $query): Builder
    {
        return $query->whereNull('parent_id');

    }// end of scope Role

    public function scopeSubCategory(Builder $query): Builder
    {
        return $query->where('parent_id', '>=' ,1);

    }// end of scope Role


    protected static function booted(): void
    {
        if(empty(request()->segment(3)) || in_array(request()->segment(3), ['categories', 'sub_categories'])) {
           static::addGlobalScope(new StatusScope);
        }

    }//end of Global Scope

}//end of model
