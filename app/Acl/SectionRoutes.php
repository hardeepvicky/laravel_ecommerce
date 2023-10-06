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

    public static function get()
    {
        $sections = [];

        $sections["Users"] = self::users();
        $sections["Roles"] = self::roles();
        $sections["Logs"] = self::logs();
        $sections["Developer Logs"] = self::developer_logs();

        return $sections;
    }

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

    private static function logs()
    {
        $routePrefix = "admin.logs";
        
        $routes =  [
            "Email" => []
        ];

        return $routes;
    }

    private static function developer_logs()
    {
        $routePrefix = "admin.logs";
        
        $routes =  [
            "Sql" => [$routePrefix . ".sql.index"],            
        ];

        return $routes;
    }

    
}