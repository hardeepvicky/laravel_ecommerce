<?php

namespace App\Http\Controllers;

use Exception;
use App\Helpers\FileUtility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class DashboardController extends WebController
{
    public function __construct()
    {
        parent::__construct();        

        $this->routePrefix = "";

        $this->viewPrefix = "backend.dashboards";

        $this->setForView([
            'msg' => 'Currently Only Configured For Admin User for Backend'
        ]);
    }

    public function index()
    {
        $this->layout = "backend.layouts.default";
        $view_name = "default";

        if (Auth::check())
        {
            $this->layout = "backend.layouts.main";
            $view_name = "admin";
        }

        $this->setForView(compact("view_name"));

        return $this->view($view_name);
    }

    public function test()
    {
        return view("backend.test");
    }

    public function theme()
    {
        return view("backend.theme");
    }

    public function developer_components()
    {
        return view("backend.developer_components");
    }

    public function ajax_upload(Request $request)
    {
        die("code not implemented");
        dd($request->get("file"));
    }

    public function ajax_upload_base64(Request $request)
    {
        $response = ["status" => 1, "msg" => ""];

        try
        {
            $base64 = $request->get("base64", null);
            $filename = $request->get("filename", null);

            if (!$base64)
            {
                throw_exception("base64 not found in request");
            }

            if (!$filename)
            {
                throw_exception("filename not found in request");
            }

            $path = Config::get('constant.path.temp');

            $response['file'] = FileUtility::base64ToFile($base64, $path, $filename);
            $response['filename'] = pathinfo($response['file'], PATHINFO_BASENAME);
        }
        catch(Exception $ex)
        {
            $response['status'] = 0;
            $response['msg'] = $ex->getMessage();
        }

        return $this->responseJson($response);
    }
}
