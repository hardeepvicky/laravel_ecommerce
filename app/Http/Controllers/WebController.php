<?php

namespace App\Http\Controllers;

use App\Helpers\DateUtility;
use App\Models\BaseModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Builder;

class WebController extends Controller
{
    /**
     * variable require for view
     */
    public String $routePrefix, $viewPrefix, $layout, $page_title;

    /**
     * variable to store data which will pass to view
     */
    private $data = [];

    public function __construct()
    {
    }

    protected function setForView(array $array)
    {
        $this->data = array_merge($this->data, $array);
    }

    protected function beforeViewRender()
    {
        $this->page_title = $this->getPageTitle();
    }

    protected function view($view_name)
    {
        $this->beforeViewRender();

        $this->data['viewPrefix'] = $this->viewPrefix;

        $this->data['routePrefix'] = $this->routePrefix;

        $this->data['layout'] = $this->layout;

        $this->data['page_title'] = $this->page_title;

        //d($this->data); exit;

        return view($this->viewPrefix . "." . $view_name, $this->data);
    }

    protected function getPageTitle()
    {
        $page_title = get_class($this);

        $arr = explode("\\", $page_title);

        if ($arr)
        {
            $page_title = end($arr);
        }
        
        $page_title = str_replace("Controller", "", $page_title);

        return $page_title;
    }

    protected function getConditions($cache_prefix, array $array, bool $return_key_value_pair_conditions = false)
    {
        $conditions = [];
        $search_variables = [];

        if ($cache_prefix)
        {
            $cache_key = "search_" . str_replace(".", "_", $cache_prefix) . "_" . auth()->id();
        }

        $request_params = request()->all();

        if (empty($request_params) && isset($cache_key))
        {
            if ( Cache::has($cache_key) )
            {
                $request_params = Cache::get($cache_key);
            }
        }

        foreach($array as $row)
        {
            if (!isset($row['field']))
            {
                throw_exception("field key in not set in argument array");
            }

            if (!isset($row['type']))
            {
                throw_exception("type key in not set in argument array");
            }

            $field = $row['field'];
            $view_field = $row['view_field'] ?? $row['field'];
            $search_variables[$view_field] = "";

            if ( !isset($request_params[$view_field]) )
            {
                continue;
            }

            $value = $search_variables[$view_field] = $request_params[$view_field];

            if (is_string($value))
            {
                $value = trim($value);
            }

            if (is_array($value))
            {
                if (!empty($value))
                {
                    $op = "IN";

                    foreach($value as $k => $v)
                    {
                        if (is_string($v))
                        {
                            $v = trim($v);
                        }

                        $arr = $this->_parseConditionValue($v, $row['type']);
                        $value[$k] = $arr['value'];
                    }

                    $parse_value = implode(",", $value);
                    if ($return_key_value_pair_conditions)
                    {
                        if ($op && $op != "=")
                        {
                            $conditions[$field . " " . $op] = $parse_value;
                        }
                        else 
                        {
                            $conditions[$field] = $parse_value;
                        }
                    }
                    else
                    {
                        $conditions[]= [$field, $op, $parse_value];
                    }
                }
            }
            else if (strlen($value) > 0)
            {
                $arr = $this->_parseConditionValue($value, $row['type']);

                $parse_value = $arr['value'];
                $op = $arr['op'];

                if ($return_key_value_pair_conditions)
                {
                    if ($op && $op != "=")
                    {
                        $conditions[$field . " " . $op] = $parse_value;
                    }
                    else 
                    {
                        $conditions[$field] = $parse_value;
                    }
                }
                else
                {
                    $conditions[]= [$field, $op, $parse_value];
                }
            }
        }

        if (isset($cache_key))
        {
            if ( !Cache::put($cache_key, $search_variables, CACHE_SEARCH_CONDITIONS_TIME) )
            {
                throw_exception("Fail to put cache");
            }
        }

        if ( !isset($this->data['search']) )
        {
            $this->data['search'] = [];
        }

        //require if getConditions function called two times
        $this->data['search'] = array_merge($this->data['search'], $search_variables);

        $this->setForView($search_variables);

        return $conditions;
    }
    
    private function _parseConditionValue($value, String $type)
    {
        $data_type = gettype($value);

        $type = strtolower(trim($type));

        if (in_array($type, ["string", "date", "from_date", "to_date", "datetime", "from_datetime", "to_datetime"]))
        {
            if ($data_type != "string")
            {
                throw_exception("input value is not typeof string");
            }
        }

        $parse_value = null;
        $op = '=';
        
        switch($type)
        {
            case "string":
                $parse_value = "%" . $value . "%";
                $op = 'LIKE';
                break;

            case "date":
                $parse_value = DateUtility::getDate($value, DateUtility::DATE_FORMAT);                
                break;

            case "from_date":
                $parse_value = DateUtility::getDate($value, DateUtility::DATE_FORMAT);
                $op = '>=';
                break;

            case "to_date":
                $parse_value = DateUtility::getDate($value, DateUtility::DATE_FORMAT);
                $op = '<=';
                break;

            case "from_datetime":
                $parse_value = DateUtility::getDate($value);
                $op = '>=';
                break;

            case "to_datetime":
                $parse_value = DateUtility::getDate($value);
                $op = '<=';
                break;

            case "int":
                $parse_value = (int) $value;                        
                break;
            
            case "from_int":
                $parse_value = (int) $value;
                $op = '>=';
                break;

            case "to_int":
                $parse_value = (int) $value;
                $op = '<=';
            break;

            case "float":
                $parse_value = (float) $value;                        
                break;

            case "from_float":
                $parse_value = (float) $value;
                $op = '>=';
                break;

            case "to_float":
                $parse_value = (float) $value;
                $op = '<=';
                break;

            default:
                $parse_value = $value;
            break;
        }

        return [
            "value" => $parse_value,
            "op" => $op
        ];
    }

    protected function getPaginagteRecords(Builder $builder)
    {
        $sort_by = request('sort_by', 'id');
        $sort_dir = request('sort_dir', 'DESC');
        $paginate_limit = request('pagination_limit', 20);

        return $builder->orderBy($sort_by, $sort_dir)->paginate($paginate_limit);
    }
}
