<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class WebController extends Controller
{
    public $routePrefix, $viewPrefix;
    private $data = [];

    protected function setForView(array $array)
    {
        $this->data = array_merge($this->data, $array);
    }

    protected function view($view_name)
    {
        $this->data['routePrefix'] = $this->routePrefix;
        
        return view($this->viewPrefix . "." . $view_name, $this->data);
    }

    protected function getConditions($cache_prefix, array $array, bool $return_key_value_pair_conditions = false)
    {
        $conditions = [];
        $search_variables = [];
        
        if ($cache_prefix)
        {
            $cache_key = "search_" . str_replace($cache_prefix, ".", "-") . "_" . auth()->id();
        }

        $request_params = request()->all();

        if (!$request_params && isset($cache_key))
        {
            if ( Cache::has($cache_key) )
            {
                $request_params = Cache::get($cache_key);
            }
        }
        
        foreach($array as $row)
        {
            $field = $row['field'];
            $view_field = $row['view_field'] ?? $row['field'];            
            $search_variables[$view_field] = $request_params[$view_field] ?? "";

            if ( !isset($request_params[$view_field]) )
            {
                continue;
            }
            
            $value = trim($request_params[$view_field]);

            if (strlen($value) > 0)
            {
                if ($return_key_value_pair_conditions)
                {
                    $conditions[$field] = $value;                    
                }
                else
                {
                    switch($row['type'])
                    {
                        case "string":
                            $conditions[]= [$field, 'LIKE', "%" . $value . "%"];
                            break;
                        
                        default:
                            $conditions[]= [$field, '=', $value];
                        break;
                    }
                }
            }
        }

        if (isset($cache_key))
        {
            Cache::put($cache_key, $search_variables, CACHE_SEARCH_CONDITIONS_TIME);
        }

        $this->setForView($search_variables);

        return $conditions;
    }
}
