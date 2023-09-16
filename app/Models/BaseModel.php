<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class BaseModel extends Model
{
    protected $unique_fields = [];

    protected static $cache_list_key = null;

    public $child_model_class = [];

    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
            // ... code here
        });

        self::created(function($model){
            Cache::forget(static::$cache_list_key);
        });

        self::updating(function($model){
            // ... code here
        });

        self::updated(function($model){
            Cache::forget(static::$cache_list_key);
        });

        self::deleting(function($model){
            // ... code here
        });

        self::deleted(function($model){
            Cache::forget(static::$cache_list_key);
        });
    }

    public function insertOrUpdate(array $data, &$is_insert = null)
    {
        $record = $this->getUniqueId($data);
        
        if ($record)
        {
            $is_insert = false;
            $record->save($data);            
        }
        else
        {
            $is_insert = true;
            $record = self::create($data);
        }

        return $record->id;
    }

    public function insertIgnoreIfExist(array $data)
    {
        $record = $this->getUniqueId($data);
        
        if (!$record)
        {
            $record = static::create($data);
        }

        return $record->id;
    }

    public function getUniqueId(array $data)
    {
        if (!$this->unique_fields)
        {
            throw_exception("unique_fields is not set yet");
        }

        $conditions = [];
        foreach($this->unique_fields as $unique_field)
        {
            if ( !isset($data[$unique_field]) )
            {
                throw_exception("field $unique_field missing in argument array");
            }

            $conditions[] = [$unique_field, '=', $data[$unique_field]];
        }
        
        $count = self::where($conditions)->count();

        if ($count == 0)
        {
            return false;
        }

        if ($count > 1)
        {
            throw_exception("more than 1 records found");
        }

        $record = self::where($conditions)->first(["id"]);

        return $record;
    }

    public static function getList(String $id = "id", String $name = "name")
    {
        $list = [];
        if ( static::$cache_list_key && Cache::has(static::$cache_list_key) )
        {
            $list = Cache::get(static::$cache_list_key);
        }
        else 
        {
            $list = static::pluck($name, $id)->toArray();

            if (static::$cache_list_key)
            {
                Cache::put(static::$cache_list_key, $list, CACHE_MODEL_LIST_TIME);
            }
        }

        return $list;
    }

    public static function getFileSavePath()
    {
        throw_exception("getFileSavePath function not declare in Model");
    }
}
