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

    public function routeNames(): HasManyThrough
    {
        return $this->hasManyThrough(RouteName::class, RoleRouteName::class);
    }
}
