<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoleRouteName extends BaseModel
{
    use HasFactory;

    public $fillable = ["role_id", "route_name_id"];

    public $unique_fields = ["role_id", "route_name_id"];
}
