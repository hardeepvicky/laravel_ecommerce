<?php
namespace App\Acl;

use App\Models\RouteName;
use Illuminate\Support\Facades\Cache;
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

    public function isAllow(String $route_name, Array $role_id_list)
    {
        $route_name = trim($route_name);
        $role_ids = implode(",", $role_id_list);

        $q = "
            SELECT
                COUNT(1) AS c
            FROM
                role_route_names RRN
                INNER JOIN route_names RR ON RR.id = RRN.route_name_id
            WHERE
                RRN.role_id IN ($role_ids) AND RR.name = '$route_name';
        ";
        
        $record = DB::select($q);

        if ($record && $record[0]->c > 0)
        {
            return true;
        }

        return false;
    }

    public function getListOfAllowedRouteNames(Array $role_id_list)
    {
        $role_ids = implode(",", $role_id_list);

        $q = "
            SELECT DISTINCT
                RR.name
            FROM
                role_route_names RRN
                INNER JOIN route_names RR ON RR.id = RRN.route_name_id
            WHERE
                RRN.role_id IN ($role_ids)
        ";

        $records = DB::select($q);

        $list = [];

        foreach($records as $record)
        {
            $list[] = $record->name;
        }

        return $list;
    }

    public function getMenuCacheKey($user_id)
    {
        return "menu_user_" . $user_id;
    }

    public function clearMenuCache(Array $user_id_list)
    {
        foreach($user_id_list as $user_id)
        {
            $cache_key = $this->getMenuCacheKey($user_id);

            Cache::forget($cache_key);
        }
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