<?php
namespace App\Acl;

use App\Models\RouteName;
use Illuminate\Support\Facades\DB;

class AccessControl
{
    private static $instance = null;
    public static bool $check_permissions = false;

    public static function init()
    {
        if (is_null(self::$instance))
        {
            self::$instance = new AccessControl();
        }

        return self::$instance;
    }

    public function getAllowedRouteNames($role_id)
    {
        $q = "
            SELECT
                *
            FROM
                role_route_names RRN
                INNER JOIN routes R ON R.id = RRN.route_name_id
            WHERE
                RRN.role_id = $role_id
        ";
        
        $records = DB::select($q);

        dd($records);
    }

    public function syncRouteNamesToDatabase()
    {
        $routeCollection = \Illuminate\Support\Facades\Route::getRoutes();

        $list = [];
        foreach($routeCollection as $route)
        {
            $name = trim($route->getName());
            if ($name)
            {
                $list[] = $name;
            }
        }

        sort($list);

        $routeNameModel = new RouteName();

        $id_list = RouteName::pluck('name', 'id')->toArray();

        $saved_route_name_list = [];

        foreach($list as $route_name)
        {
            if (!in_array($route_name, SectionRoutes::$public_routes))
            {
                $id = $routeNameModel->insertIgnoreIfExist(["name" => $route_name]);
                unset($id_list[$id]);

                $saved_route_name_list[$route_name] = $id;
            }            
        }

        if ($id_list)
        {
            RouteName::destroy(array_keys($id_list));
        }

        return $saved_route_name_list;
    }
}