<?php
namespace App\Helpers;

class Menu
{
    private static $menu = [];
    private static $current_route_name = "";
    public static function get()
    {
        //$current_url = strtolower(request()->path());
        //self::$current_url = strtolower("Users/index");

        self::_home();
        self::_member_manager();
        self::_system_manager();
        self::_logs();

        return self::$menu;
    }

    
    private static function addLink(String $route_name, String $title, String $icon)
    {
        $arr = [
            "title" => $title,
            "icon" => $icon,
            "route_name" => trim($route_name)
        ];

        $arr['is_active'] = strtolower($arr['route_name']) == self::$current_route_name;

        return $arr;
    }

    private static function getControllerLinks(String $routePrefix, String $title, String $icon)
    {
        $links = [
            "title" => $title,
            "icon" => $icon,
            "links" => [
                self::addLink($routePrefix . ".index", "Summary", FontAwesomeIcon::SUMMARY),
                self::addLink($routePrefix . ".create", "Add", FontAwesomeIcon::ADD),
            ],
        ];

        return $links;
    }

    private static function _home()
    {
        $links = [];

        $links[] = self::addLink("admin.dashboard", "Dashboard", 'bx bxs-dashboard');
       
        self::$menu[] = [
            'title' => 'Home',
            'icon' => 'fas fa-home',
            'links' => $links,
        ];
    }

    private static function _member_manager()
    {
        $links = [];        
        $links[] = self::getControllerLinks("admin.users", "Users", "fas fa-users");
        $links[] = self::getControllerLinks("admin.roles", "Roles", "fas fa-table");

        self::$menu[] = [
            'title' => 'Member Manager',
            'icon' => 'fas fa-users',
            'links' => $links,
        ];
    }

    private static function _system_manager()
    {
        $links = [];        
        
        $routePrefix = "admin.permissions";
        $links[] = [
            "title" => "Permissions",
            "icon" => "fas fa-bars",
            "links" => [
                self::addLink($routePrefix . ".index", "Summary", FontAwesomeIcon::SUMMARY),
                self::addLink($routePrefix . ".assign", "Assign", 'bx bx-grid-alt'),
                self::addLink($routePrefix . ".assign_to_many", "Assign To Many", 'bx bx-grid-alt'),
            ],
        ];

        self::$menu[] = [
            'title' => 'System Manager',
            'icon' => 'fas fa-cogs',
            'links' => $links,
        ];
    }

    private static function _logs()
    {
        $links = [];
        $routePrefix = "admin.logs";
        
        $links[] = [
            "title" => "Developer",
            "icon" => "fas fa-bars",
            "links" => [
                self::addLink($routePrefix . ".sql.index", "SQL", FontAwesomeIcon::SUMMARY)
            ],
        ];

        self::$menu[] = [
            'title' => 'Logs',
            'icon' => 'fas fa-layer-group',
            'links' => $links,
        ];
    }
}