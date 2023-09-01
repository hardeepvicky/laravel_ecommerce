<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    public $url_prefix, $view_prefix;
    private $data = [];

    protected function setForView(array $array)
    {
        $this->data = array_merge($this->data, $array);
    }

    protected function view($view_name)
    {
        return view($this->view_prefix . "." . $view_name, $this->data);
    }

    protected function getConditions(array $array)
    {
        $conditions = [];
        $search_variables = [];

        foreach($array as $row)
        {
            $field = $row['field'];
            $view_field = $row['view_field'] ?? $row['field'];
            $value = trim(request()->query($view_field));

            if (strlen($value) > 0)
            {
                switch($row['type'])
                {
                    case "string":
                        $conditions[]= [$field, 'LIKE', "%" . $value . "%"];
                        break;
                    
                    default:
                    $conditions[]= [$field, '=', "%" . $value . "%"];
                    break;
                }
            }
            $search_variables[$view_field] = $value;
        }

        $this->setForView($search_variables);

        return $conditions;
    }

    public function clearSearchCache($view_name)
    {
        return redirect($this->url_prefix);
    }
}
