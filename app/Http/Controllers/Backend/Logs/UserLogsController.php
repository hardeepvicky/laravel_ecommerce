<?php

namespace App\Http\Controllers\Backend\Logs;

use App\Http\Controllers\Backend\BackendController;
use App\Models\EmailLog;
use Illuminate\Support\Facades\Route;

class UserLogsController extends BackendController
{
    public function __construct()
    {
        parent::__construct();
        $this->routePrefix = "admin.logs.user";
        $this->viewPrefix = "backend.logs.user";
    }

    public function email()
    {
        $modelName = "EmailLog";

        $conditions = $this->getConditions(Route::currentRouteName(), [
            ["field" => "from_email", "type" => "string", "view_field" => "from_email"],
            ["field" => "to_email", "type" => "string", "view_field" => "to_email"],
            ["field" => "created", "type" => "from_date", "view_field" => "from_date"],
            ["field" => "created", "type" => "to_date", "view_field" => "to_date"],
        ]);

        $records = $this->getPaginagteRecords(EmailLog::where($conditions));

        //dd($records);

        $this->setForView(compact("records", "modelName"));

        return $this->view(__FUNCTION__);
    }
}
