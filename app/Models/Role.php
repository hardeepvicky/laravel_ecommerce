<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Role extends BaseModel
{
    use HasFactory;

    public $fillable = ["name"];

    public $unique_fields = ["name"];

    public static $cache_list_key = "RoleList";

    public $child_model_class = [
        UserRole::class => [
            "foreignKey" => "role_id",
            "preventDelete" => true,
        ],
        RoleRouteName::class => [
            "foreignKey" => "role_id",
            "preventDelete" => false,
        ],
    ];

    public function userRole()
    {
        return $this->hasMany(UserRole::class, 'role_id');
    }

    public function routeNames(): HasManyThrough
    {
        return $this->hasManyThrough(RouteName::class, RoleRouteName::class);
    }

    public function scopeWithAll($query) 
    {
        $query->with('userRole');
    }
}
