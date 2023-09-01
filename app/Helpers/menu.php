<?php
namespace App\Helpers;

class Menu
{
    private static $menu = [];
    private static $current_url = "";
    public static function get()
    {
        //$current_url = strtolower(request()->path());
        self::$current_url = strtolower("Users/index");

        self::_home();

        

        return self::$menu;
    }

    
    private static function addLink(String $url, String $title, String $icon)
    {
        $arr = [
            "title" => $title,
            "icon" => $icon,
            "url" => trim($url)
        ];

        $arr['is_active'] = strtolower($arr['url']) == self::$current_url;

        return $arr;
    }

    private static function getControllerLinks(String $url_prefix, String $title, String $icon)
    {
        $links = [
            "title" => $title,
            "icon" => $icon,
            "links" => [
                self::addLink($url_prefix, "Summary", FontAwesomeIcon::SUMMARY),
                self::addLink($url_prefix . "/create", "Add", FontAwesomeIcon::ADD),
            ],
        ];

        return $links;
    }

    private static function _home()
    {
        $links = [];
        $url_prefix = "/users";
        $links[] = self::getControllerLinks($url_prefix, "Users", "fas fa-users");
        $links[] = self::addLink($url_prefix . "/test", "Test", FontAwesomeIcon::SUMMARY);

        self::$menu['home'] = [
            'title' => 'Home',
            'icon' => 'fas fa-home',
            'links' => $links,
        ];
    }
}