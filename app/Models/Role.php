<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use \Illuminate\Database\Eloquent\Relations\BelongsToMany;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $guarded = [];

    public function scopeRoleNot(Builder $query, $rolesName = ['super_admin']): Builder
    {
        return $query->when($rolesName, fn ($query) => $query->whereNotIn('name', $rolesName));

    }// end of scope Role

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'role_has_permissions', 'role_id');

    }//end of belongsToMany permissions

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);

    }//end of admin

    public function admins()
    {
        return $this->belongsToMany(Permission::class, 'role_has_permissions', 'role_id');

    }//end of belongsToMany admin

}//end of model