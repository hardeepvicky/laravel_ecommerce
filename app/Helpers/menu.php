<?php
namespace App\Helpers;

use App\Acl\AccessControl;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class Menu
{
    private static $menus = [];
    private static $current_route_name = "";

    const CACHE_TIME = CACHE_MENU_TIME;

    const DEFAULT_ICON_MAIN_MENU = 'fas fa-layer-group';

    public static function setCurrentRouteName(String $current_route_name)
    {
        self::$current_route_name = strtolower(trim($current_route_name));        
    }

    
    public static function get($auth_user_id)
    {
        self::$menus = [];

        if ( Config::get('app.will_menu_cache') )
        {
            $acccessControl = AccessControl::init();

            $cache_key = $acccessControl->getMenuCacheKey($auth_user_id);

            self::$menus = Cache::get($cache_key);

            if (!empty(self::$menus))
            {
                return self::$menus;
            }
        }

        self::_home();
        self::_member_manager();
        self::_system_manager();
        self::_logs();

        if ( isset($cache_key) )
        {
            self::_filterMenuForUser();

            Cache::put($cache_key, self::$menus, self::CACHE_TIME);
        }

        return self::$menus;
    }

    public static function getBreadcums($menus)
    {
        $breadcums = self::findBreadCum($menus);

        return $breadcums;
    }

    
    private static function findBreadCum(Array $menus, Array $parents = [])
    {
        foreach($menus as $menu)
        {
            $aray_helper = new ArrayHelper($menu);
            $parent = $aray_helper->getOnlyWhichHaveKeys(["title", "icon", "route_name"]);

            if (isset($menu['links']))
            {
                $temp = $parents;
                $temp[] = $parent;
                $ret = self::findBreadCum($menu['links'], $temp);

                if ($ret)
                {
                    return $ret;
                }
            }

            if (isset($menu['related_links']))
            {
                foreach($menu['related_links'] as $related_link)
                {
                    if (isset($related_link['route_name']))
                    {
                        if ($related_link['route_name'] == self::$current_route_name)
                        {
                            $parents[] = $parent;
                            return $parents;
                        }
                    }
                }
            }

            if (isset($menu['route_name']))
            {
                if ($menu['route_name'] == self::$current_route_name)
                {
                    $parents[] = $parent;
                    return $parents;
                }
            }
        }

        return [];
    }

    public static function getList(Array $menus, String $prefix = "")
    {
        $list = [];
        foreach($menus as $menu)
        {  
            if ( isset($menu['route_name']) )
            {
                $list[] = [
                    "title" => $prefix . $menu['title'],
                    "url" => route($menu['route_name'])
                ];
            }
            else if (isset($menu["links"]))
            {
                $list = array_merge($list, self::getList($menu["links"], $prefix . $menu['title'] . " -> "));
            }
        }

        return $list;
    }

    private static function _filterMenuForUser()
    {
        $role_id_list = [];
        foreach(Auth::user()->userRole->toArray() as $user_role)
        {
            $role_id_list[] = $user_role['role_id'];
        }

        $acccessControl = AccessControl::init();
        $allowed_route_name_list = $acccessControl->getListOfAllowedRouteNames($role_id_list);
        //d($allowed_route_name_list);

        foreach(self::$menus as $k => $sub_menu)
        {
            if (isset($sub_menu['links']))
            {
                foreach($sub_menu['links'] as $k2 => $sub_menu2)
                {
                    if (isset($sub_menu2['links']))
                    {
                        foreach($sub_menu2['links'] as $k3 => $sub_menu3)
                        {
                            if (isset($sub_menu3['route_name']))
                            {
                                if (!in_array($sub_menu3['route_name'], $allowed_route_name_list))
                                {
                                    unset($sub_menu2['links'][$k3]);
                                }
                            }
                        }

                        if (empty($sub_menu2['links']))
                        {
                            unset($sub_menu['links'][$k2]);
                        }
                        else
                        {
                            $sub_menu['links'][$k2] = $sub_menu2;
                        }
                    }
                    else if (isset($sub_menu2['route_name']))
                    {
                        if (!in_array($sub_menu2['route_name'], $allowed_route_name_list))
                        {
                            unset($sub_menu['links'][$k2]);
                        }
                    }
                }
            }
            else if (isset($sub_menu['route_name']))
            {
                if (!in_array($sub_menu['route_name'], $allowed_route_name_list))
                {
                    unset(self::$menus[$k]);
                }
            }

            if (empty($sub_menu['links']))
            {
                unset(self::$menus[$k]);
            }
            else
            {
                self::$menus[$k] = $sub_menu;
            }
        }
    }

    private static function addMenu($menu)
    {
        if (!isset($menu["title"]))
        {
            throw_exception("title is not set in menu argument");
        }

        if (!isset($menu["links"]))
        {
            throw_exception("links is not set in menu argument");
        }

        if (!isset($menu["icon"]))
        {
            $menu["icon"] = self::DEFAULT_ICON_MAIN_MENU;
        }

        self::$menus[] = $menu;
    }


    private static function getLink(String $route_name, String $title, String $icon, Array $related_links = [])
    {
        $arr = [
            "title" => $title,
            "icon" => "menu-icon " . $icon,
            "route_name" => trim($route_name),
            "related_links" => $related_links
        ];

        $arr['is_active'] = strtolower($arr['route_name']) == self::$current_route_name;

        return $arr;
    }

    private static function addRelatedLink(String $route_name, String $title, String $icon = "")
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
            "icon" => "menu-icon " . $icon,
            "links" => [
                self::getLink($routePrefix . ".index", "Summary", Config::get('constant.font_awesome_icon.summary'), [
                    self::addRelatedLink($routePrefix . ".edit", "Edit")
                ]),
                self::getLink($routePrefix . ".create", "Create", Config::get('constant.font_awesome_icon.create')),
            ],
        ];

        return $links;
    }

    private static function _home()
    {
        $links = [];

        $links[] = self::getLink("admin.dashboard", "Dashboard", 'bx bxs-dashboard');

        self::addMenu([
            'title' => 'Home',
            'icon' => 'fas fa-home',
            'links' => $links,
        ]);
    }

    private static function _member_manager()
    {
        $links = [];
        $links[] = self::getControllerLinks("admin.users", "Users", "fas fa-users");
        $links[] = self::getControllerLinks("admin.roles", "Roles", "fas fa-cube");

        self::addMenu([
            'title' => 'Member Manager',
            'icon' => 'fas fa-users',
            'links' => $links,
        ]);
    }

    private static function _system_manager()
    {
        $links = [];

        $routePrefix = "admin.permissions";

        $links[] = [
            "title" => "Permissions",
            "icon" => "fas fa-cube menu-icon",
            "links" => [
                self::getLink($routePrefix . ".index", "Summary", Config::get('constant.font_awesome_icon.summary')),
                self::getLink($routePrefix . ".assign", "Assign", 'bx bx-grid-alt'),
                self::getLink($routePrefix . ".assign_to_many", "Assign To Many", 'bx bx-grid-alt'),
            ],
        ];

        self::addMenu([
            'title' => 'System Manager',
            'icon' => 'fas fa-cogs',
            'links' => $links,
        ]);
    }

    private static function _logs()
    {
        $links = [];
        $routePrefix = "admin.logs";

        $links[] = [
            "title" => "Developer",
            "icon" => "fas fa-cube menu-icon",
            "links" => [
                self::getLink($routePrefix . ".sql.index", "SQL", Config::get('constant.font_awesome_icon.summary'))
            ],
        ];

        self::addMenu([
            'title' => 'Logs',
            'links' => $links,
        ]);
    }
}