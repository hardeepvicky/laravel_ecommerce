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
        $links[] = self::getControllerLinks("admin.users", "Users", "fas fa-users");
        $links[] = self::getControllerLinks("admin.roles", "Roles", "fas fa-table");

        self::$menu[] = [
            'title' => 'Home',
            'icon' => 'fas fa-home',
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