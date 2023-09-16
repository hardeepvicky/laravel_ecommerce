<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class SqlLog extends BaseModel
{
    use HasFactory;

    public $fillable = ["route_name", "sql_query_file", "sql_dml_query_file", "have_heavy_query"];

    public static function getFileSavePath()
    {
        return "files/SqlLog/";
    }
}
