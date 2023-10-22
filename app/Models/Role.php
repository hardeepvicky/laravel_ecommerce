<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Role extends BaseModel
{
    use HasFactory;

    /**
     * name of table fields which uniquly identify the record
     */
    protected static Array $unique_fields = ["name"];

    /**
     * set extra relationship array to overcome problem of accidential delete
     * this variable used in Controller.php -> delete()
     */
    public static Array $child_model_class = [
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
