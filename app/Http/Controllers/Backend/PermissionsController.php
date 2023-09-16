<?php

namespace App\Http\Controllers\Backend;

use App\Acl\AccessControl;
use App\Acl\SectionRoutes;
use App\Models\Role;
use App\Models\RoleRouteName;
use App\Models\RouteName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class PermissionsController extends BackendController
{
    public function __construct()
    {
        $this->routePrefix = "admin.permissions";
        $this->viewPrefix = "backend.permissions";
    }

    public function index()
    {
        return $this->view("index");
    }

    public function assign(Request $request)
    {
        $sections = SectionRoutes::get();

        if ($request->isMethod('post'))
        {
            $accessControl = AccessControl::init();
            $saved_route_name_list = $accessControl->syncRouteNamesToDatabase();
            
            $data = $request->all();

            //d($sections);

            $choosen_route_list = [];
            foreach($data['data'] as $section_name => $data_actions)
            {
                if (isset($sections[$section_name]))
                {
                    foreach($data_actions as $action_name)
                    {
                        if ( isset($sections[$section_name][$action_name]))
                        {
                            $choosen_route_list = array_merge($choosen_route_list, $sections[$section_name][$action_name]);
                        }
                    }
                }
            }

            $choosen_route_list = array_unique($choosen_route_list);

            $roleRouteName = new RoleRouteName();

            
            foreach($choosen_route_list as $route_name)
            {
                if (!isset($saved_route_name_list[$route_name]))
                {
                    die("$route_name not found in saved_route_name_list. may be you forgot to save in SectionRoutes.php");
                }

                $roleRouteName->insertIgnoreIfExist([
                    "role_id" => $data['role_id'],
                    "route_name_id" => $saved_route_name_list[$route_name],
                ]);
            }

            $this->saveSqlLog();

            Session::flash('success', 'Permission are saved');
        }

        $role_list = Role::getList();

        //d($sections); exit;

        $this->setForView(compact("role_list", "sections"));

        return $this->view("assign");
    }
}
