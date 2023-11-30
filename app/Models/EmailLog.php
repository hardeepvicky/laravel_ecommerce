<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmailLog extends BaseModel
{
    use HasFactory;

    public static function getFileSavePath()
    {
        return "files/EmailLog/";
    }
}
