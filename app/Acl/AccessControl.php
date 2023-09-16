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

        dd($routeCollection);
        
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

        foreach($list as $route_name)
        {
            if (!in_array($route_name, SectionRoutes::$public_routes))
            {
                $id = $routeNameModel->insertOrUpdate(["name" => $route_name], $is_insert);
                unset($id_list[$id]);
            }            
        }

        if ($id_list)
        {
            RouteName::destroy($id_list);
        }
    }
}