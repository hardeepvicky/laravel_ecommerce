<?php
namespace App\Acl;

class SectionRoutes
{
    /**
     * list of routes which are allowed for any login user
     */
    public const ALLOW_ROUTES_FOR_ANY_LOGIN_USER = [
    ];

    /**
     * list of routes for system admin role
     */
    public const ALLOW_ROUTES_FOR_SYSTEM_ADMIN = [
        'admin.permissions.index',
        'admin.permissions.assign',
        'admin.permissions.assign_to_many',
        'admin.permissions.ajax_delete',
        'admin.permissions.ajax_get_permissions',
    ];

    /**
     * function to retrive all sections
     */
    public static function get()
    {
        $sections = [];

        $sections["Dashboard"] = self::dashboard();
        $sections["Users"] = self::users();
        $sections["Roles"] = self::roles();

        $sections["User Logs"] = self::user_logs();
        $sections["System Logs"] = self::system_logs();
        $sections["Developer Logs"] = self::developer_logs();
        $sections["Developer"] = self::developer();


        return $sections;
    }

    protected static function commonRoutes($routePrefix)
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

    private static function dashboard()
    {
        $routePrefix = "admin.dashboard";

        $routes =  [
            "Dashbaord" => [$routePrefix],
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

    private static function user_logs()
    {
        $routePrefix = "admin.logs.user";

        $routes =  [
            "Email" => []
        ];

        return $routes;
    }

    private static function system_logs()
    {
        $routePrefix = "admin.logs.system";

        $routes =  [
            "Cron" => []
        ];

        return $routes;
    }

    private static function developer_logs()
    {
        $routePrefix = "admin.logs.developer";

        $routes =  [
            "Sql" => [$routePrefix . ".sql"],
        ];

        return $routes;
    }


    private static function developer()
    {
        $routePrefix = "admin.developer";

        $routes = [];

        $routes["Laravel Routes Summary"] = [$routePrefix . ".laravel_routes_index"];
        
        return $routes;
    }

}