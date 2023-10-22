<?php

namespace App\Http\Controllers;

use App\Models\BaseModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Builder;

class WebController extends Controller
{
    /**
     * variable require for view
     */
    public String $routePrefix, $viewPrefix, $layout;

    /**
     * variable to store data which will pass to view
     */
    private $data = [];

    public function __construct()
    {
        $request = request();

        if ( $request->ajax() ) {
            $this->layout = "backend.layouts.ajax";
        }
        else {
            $this->layout = "backend.layouts.default";
        }
    }

    protected function setForView(array $array)
    {
        $this->data = array_merge($this->data, $array);
    }

    protected function view($view_name)
    {
        $this->data['routePrefix'] = $this->routePrefix;

        $this->data['layout'] = $this->layout;
        
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

    protected function getPaginagteRecords(Builder $builder)
    {
        $sort_by = request('sort_by', 'id');
        $sort_dir = request('sort_dir', 'DESC');
        $paginate_limit = request('pagination_limit', 20);

        return $builder->orderBy($sort_by, $sort_dir)->paginate($paginate_limit);
    }
}
