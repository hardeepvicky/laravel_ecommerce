<?php

namespace App\Http\Controllers\Backend\Logs;

use App\Http\Controllers\Backend\BackendController;
use App\Models\SqlLog;
use Illuminate\Support\Facades\Route;

class SystemLogsController extends BackendController
{
    public function __construct()
    {
        parent::__construct();
        $this->routePrefix = "admin.logs.system";
        $this->viewPrefix = "backend.logs.system";
    }

    public function sql()
    {
        $modelName = "SqlLog";

        $conditions = $this->getConditions(Route::currentRouteName(), [
            ["field" => "route_name_or_url", "type" => "string", "view_field" => "route_name_or_url"],
            ["field" => "created", "type" => "from_date", "view_field" => "from_date"],
            ["field" => "created", "type" => "to_date", "view_field" => "to_date"],
        ]);

        $records = $this->getPaginagteRecords(SqlLog::where($conditions));

        $this->setForView(compact("records", "modelName"));

        return $this->view(__FUNCTION__);
    }
}
