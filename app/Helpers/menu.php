<?php
namespace App\Helpers;

use App\Acl\AccessControl;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class Menu
{
    private static $menu = [];
    private static $current_route_name = "";
    public static function get()
    {
        $acccessControl = AccessControl::init();

        $cache_key = $acccessControl->getMenuCacheKey(Auth::user()->id);

        if ( Config::get('app.will_menu_cache') )
        {
            $menu = Cache::get($cache_key);        

            if (!empty($menu))
            {
                return $menu;
            }
        }

        self::_home();
        self::_member_manager();
        self::_system_manager();
        self::_logs();

        if ( Config::get('app.will_menu_cache') )
        {
            self::_filterMenuForUser();

            Cache::put($cache_key, self::$menu, CACHE_MENU_TIME);
        }

        return self::$menu;
    }

    
    private static function addLink(String $route_name, String $title, String $icon)
    {
        $arr = [
            "title" => $title,
            "icon" => "menu-icon " . $icon,
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
                self::addLink($routePrefix . ".index", "Summary", FontAwesomeIcon::SUMMARY),
                self::addLink($routePrefix . ".create", "Create", FontAwesomeIcon::ADD),
            ],
        ];

        return $links;
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

        foreach(self::$menu as $k => $sub_menu)
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
                    unset(self::$menu[$k]);
                }
            }

            if (empty($sub_menu['links']))
            {
                unset(self::$menu[$k]);
            }
            else
            {
                self::$menu[$k] = $sub_menu;
            }
        }
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
            "icon" => "fas fa-bars menu-icon",
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
            "icon" => "fas fa-bars menu-icon",
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