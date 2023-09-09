<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserRole extends BaseModel
{
    use HasFactory;

    public $fillable = ["role_id", "user_id"];

    public $unique_fields = ["role_id", "user_id"];
}
