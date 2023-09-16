<?php
namespace App\Acl;

class SectionRoutes
{
    public static $public_routes = [];

    private static function commonRoutes($routePrefix)
    {
        $routes =  [
            "Summary" => [$routePrefix . ".index"],
            "Add" => [
                $routePrefix . ".create", 
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
        $sections["Roles"] = self::roles();
        $sections["Permissions"] = self::permissions();

        return $sections;
    }

    private static function users()
    {
        $routePrefix = "admin.users";
        
        $routes = self::commonRoutes($routePrefix);

        return $routes;
    }

    private static function roles()
    {
        $routePrefix = "admin.roles";
        
        $routes = self::commonRoutes($routePrefix);

        return $routes;
    }

    private static function permissions()
    {
        $routePrefix = "admin.permissions";
        
        $routes =  [
            "Summary" => [$routePrefix . ".index"],
            "Assign" => [
                $routePrefix . ".assign",                 
            ],
            "Assign to Many" => [
                $routePrefix . ".assign_to_many",                 
            ],
            "Delete" => [$routePrefix . ".destroy"]
        ];

        return $routes;
    }
}