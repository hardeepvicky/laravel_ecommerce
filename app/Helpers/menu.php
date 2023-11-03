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

    public static function setCurrentRouteName(String $current_route_name)
    {
        self::$current_route_name = strtolower(trim($current_route_name));        
        BaseMenu::setCurrentRouteName(self::$current_route_name);
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

        self::$menus[] = (new HomeMenu)->get();
        self::$menus[] = (new MemberMenu)->get();
        self::$menus[] = (new SystemMenu)->get();
        self::$menus[] = (new LogMenu)->get();

        //d(self::$menus); exit;

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

        //d($breadcums); exit;

        return $breadcums;
    }

    
    private static function findBreadCum(Array $menus, Array $parents = [])
    {
        foreach($menus as $menu)
        {
            $aray_helper = new ArrayHelper($menu);
            $parent = $aray_helper->getOnlyWhichHaveKeys(["title", "route_name"]);

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

                            $aray_helper = new ArrayHelper($related_link);
                            $temp = $aray_helper->getOnlyWhichHaveKeys(["title", "route_name"]);

                            $parents[] = $temp;

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

}

class BaseMenu
{
    const ICON_MENU_ROOT = 'fas fa-layer-group';
    const ICON_MENU_ROOT_CHILD = 'fas fa-cube';
    const ICON_MENU_SUMMARY = 'fas fa-table';
    const ICON_MENU_CREATE = 'fas fa-plus-circle';

    private static $current_route_name = "";

    public static function setCurrentRouteName(String $current_route_name)
    {
        self::$current_route_name = strtolower(trim($current_route_name));        
    }

    public static function get() : Array
    {
        return [];
    }

    public static function getModule(String $title, $icon, Array $links = [])
    {
        if (!$icon)
        {
            $icon = self::ICON_MENU_ROOT;
        }

        return [
            'title' => $title,
            'icon' => $icon,
            "links" => $links
        ];
    }


    public static function getLink(String $route_name, String $title, String $icon, Array $related_links = [])
    {
        $link = [
            "title" => $title,
            "icon" => "child-menu-icon " . $icon,
            "route_name" => trim($route_name),
            "related_links" => $related_links
        ];

        $link['is_active'] = self::isActiveLink($link);

        return $link;
    }

    public static function addRelatedLink(String $route_name, String $title, Array $related_links = [])
    {
        $link = [
            "title" => $title,
            "route_name" => trim($route_name),
            "related_links" => $related_links
        ];

        $link['is_active'] = self::isActiveLink($link);

        return $link;
    }

    public static function isActiveLink(Array $link)
    {
        if ($link['route_name'] == self::$current_route_name)
        {
            return true;
        }
        else if (isset($link["related_links"]) && is_array($link["related_links"]))
        {
            foreach($link["related_links"] as $related_link)
            {
                $is_active = self::isActiveLink($related_link);

                if ($is_active)
                {
                    return true;
                }
            }
        }

        return false;
    }

    public static function getControllerDefaultLinks(String $routePrefix, String $title, String $icon = "")
    {
        $links = [
            "title" => $title,
            "icon" => $icon,
            "links" => [
                self::getLink($routePrefix . ".index", "Summary", self::ICON_MENU_SUMMARY, [
                    self::addRelatedLink($routePrefix . ".edit", "Edit"),
                    self::addRelatedLink($routePrefix . ".view", "View"),
                ]),
                self::getLink($routePrefix . ".create", "Create", self::ICON_MENU_CREATE),
            ],
        ];

        return $links;
    }
}

class HomeMenu extends BaseMenu
{
    public static function get() : Array
    {
        $links = [];

        $links[] = self::getLink("admin.dashboard", "Dashboard", 'bx bxs-dashboard');

        return self::getModule("Home", 'fas fa-home', $links);
    }
}

class SystemMenu extends BaseMenu
{
    public static function get() : Array
    {
        $links = [];

        $links[] = self::permission();

        return self::getModule("System Manager", 'fas fa-cogs', $links);
    }

    public static function permission()
    {
        $routePrefix = "admin.permissions";

        $links = [
            self::getLink($routePrefix . ".index", "Summary", self::ICON_MENU_SUMMARY),
            self::getLink($routePrefix . ".assign", "Assign", 'bx bx-grid-alt'),
            self::getLink($routePrefix . ".assign_to_many", "Assign To Many", 'bx bx-grid-alt'),
        ];

        return self::getModule("Permissions", self::ICON_MENU_ROOT_CHILD, $links);
    }
}

class LogMenu extends BaseMenu
{
    public static function get() : Array
    {
        $links = [];

        $links[] = self::user_logs();
        $links[] = self::system_logs();
        $links[] = self::developer_logs();

        return self::getModule("Log Manager", null, $links);
    }

    public static function user_logs()
    {
        $links = [];

        return self::getModule("User Logs", self::ICON_MENU_ROOT_CHILD, $links);
    }

    public static function system_logs()
    {
        $links = [];

        return self::getModule("System Logs", self::ICON_MENU_ROOT_CHILD, $links);
    }

    public static function developer_logs()
    {
        $routePrefix = "admin.logs.developer";

        $links = [
            self::getLink($routePrefix . ".sql", "SQL", self::ICON_MENU_SUMMARY)
        ];

        return self::getModule("Develoepr Logs", self::ICON_MENU_ROOT_CHILD, $links);
    }
}

class MemberMenu extends BaseMenu
{
    public static function get() : Array
    {
        $links = [];

        $links[] = self::user();
        $links[] = self::role();

        return self::getModule("Member Manager", 'fas fa-users', $links);
    }

    private static function user()
    {
        $routePrefix = "admin.users";

        $links = self::getControllerDefaultLinks($routePrefix, "Users", "fas fa-users");

        return $links;
    }

    private static function role()
    {
        $routePrefix = "admin.roles";

        $links = self::getControllerDefaultLinks($routePrefix, "Roles", self::ICON_MENU_ROOT_CHILD);

        return $links;
    }
}