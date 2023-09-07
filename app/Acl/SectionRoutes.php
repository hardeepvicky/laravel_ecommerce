<?php
namespace App\Acl;

class SectionRoutes
{
    public static $public_routes = [
        "users.clear_search_cache",
    ];

    private static function commonRoutes($route_prefix)
    {
        $routes =  [
            "Summary" => [$route_prefix . ".index"],
            "Add" => [
                $route_prefix . ".add", 
                $route_prefix . ".store"
            ],
            "Edit" => [
                $route_prefix . ".edit", 
                $route_prefix . ".update"
            ],
            "Delete" => [$route_prefix . ".destroy"]
        ];

        return $routes;
    }

    public static function get()
    {
        $sections = [];

        $sections["Users"] = self::users();
    }

    private static function users()
    {
        $route_prefix = "users";
        
        $routes = self::commonRoutes($route_prefix);

        return $routes;
    }
}