<?php
namespace App\Acl;

class SectionRoutes
{
    public static $public_routes = [
        'admin.permissions.ajax_get_permissions'
    ];

    public static $allow_routes_for_admin_role = [
        'admin.permissions.index',
        'admin.permissions.assign',
        'admin.permissions.assign_to_many',
        'admin.permissions.destroy',
    ];

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

    
}