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
        return $this->view(__FUNCTION__);
    }

    public function assign(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $sections = SectionRoutes::get();

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

            $delete_id_list = RoleRouteName::where("role_id", "=", $data['role_id'])->pluck("id", "id");
            foreach($choosen_route_list as $route_name)
            {
                if (!isset($saved_route_name_list[$route_name]))
                {
                    die("$route_name not found in saved_route_name_list. may be you forgot to save in SectionRoutes.php");
                }

                $saved_id = $roleRouteName->insertIgnoreIfExist([
                    "role_id" => $data['role_id'],
                    "route_name_id" => $saved_route_name_list[$route_name],
                ]);

                unset($delete_id_list[$saved_id]);
            }

            foreach(SectionRoutes::$allow_routes_for_admin_role as $route_name)
            {
                if (!isset($saved_route_name_list[$route_name]))
                {
                    die("$route_name not found in saved_route_name_list. may be you forgot to save in SectionRoutes.php");
                }

                $saved_id = $roleRouteName->insertIgnoreIfExist([
                    "role_id" => $data['role_id'],
                    "route_name_id" => $saved_route_name_list[$route_name],
                ]);

                unset($delete_id_list[$saved_id]);
            }

            RoleRouteName::destroy($delete_id_list);

            $this->saveSqlLog();

            Session::flash('success', 'Permission are saved');
        }

        $role_list = Role::getList();

        $this->setForView(compact("role_list"));

        return $this->view(__FUNCTION__);
    }

    public function ajax_get_permissions($role_id)
    {
        $role_route_names = RoleRouteName::select(['role_id', 'route_name_id'])->where("role_id", "=", $role_id)
            ->with(['routeName' => function ($query) {
                $query->select(['id', 'name']);
            }])->get();

        $saved_route_list = [];

        foreach($role_route_names->toArray() as $role_route)
        {
            $saved_route_list[] = $role_route['route_name']['name'];
        }

        $sections = SectionRoutes::get();

        foreach($sections as $section_name => $actions)
        {
            foreach($actions as $action_name => $route_list)
            {
                unset($actions[$action_name]);

                $is_checked = false;
                foreach($route_list as $route_name)
                {
                    if (in_array($route_name, $saved_route_list))
                    {
                        $is_checked = true;
                    }
                }

                $actions[$action_name]['is_checked'] = $is_checked;
            }

            $sections[$section_name] = $actions;
        }

        $this->setForView(compact("sections"));

        return $this->view(__FUNCTION__);
    }
}
