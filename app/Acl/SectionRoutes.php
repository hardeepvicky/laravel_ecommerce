<?php
namespace App\Acl;

class SectionRoutes
{
    public static $public_routes = [
        "users.clear_search_cache",
    ];

    private static function commonRoutes($routePrefix)
    {
        $routes =  [
            "Summary" => [$routePrefix . ".index"],
            "Add" => [
                $routePrefix . ".add", 
                $routePrefix . ".store"
            ],
            "Edit" => [
                $routePrefix . ".edit", 
                $routePrefix . ".update"
            ],
            "Delete" => [$routePrefix . ".destroy"]
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
        $routePrefix = "users";
        
        $routes = self::commonRoutes($routePrefix);

        return $routes;
    }
}