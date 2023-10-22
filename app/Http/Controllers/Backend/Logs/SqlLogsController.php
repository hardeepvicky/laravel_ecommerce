<?php

namespace App\Http\Controllers\Backend\Logs;

use App\Http\Controllers\Backend\BackendController;
use App\Models\SqlLog;
use Illuminate\Support\Facades\Route;

class SqlLogsController extends BackendController
{
    public function __construct()
    {
        parent::__construct();
        $this->routePrefix = "admin.logs.sql";
        $this->viewPrefix = "backend.logs.sql";
    }

    public function index()
    {
        $modelName = "SqlLog";

        $conditions = $this->getConditions(Route::currentRouteName(), [
            ["field" => "route_name_or_url", "type" => "string", "view_field" => "route_name_or_url"],            
        ]);

        $records = SqlLog::where($conditions)->orderBy('id', 'desc')->paginate(50);

        $this->setForView(compact("records", "modelName"));

        return $this->view("index");
    }
}
