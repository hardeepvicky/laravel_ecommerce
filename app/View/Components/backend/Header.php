<?php

namespace App\View\Components\Backend;

use App\Helpers\Menu;
use App\View\Components\BaseComponent;

class Header extends BaseComponent
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->view_path = "components.backend.header";

        $menus = Menu::get();

        $menu_autocomplete_list = $this->_getMenuAutoCompleteList($menus);

        $this->setForView(compact("menu_autocomplete_list"));
    }

    private function _getMenuAutoCompleteList($menus, $prefix = "")
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
                $list = array_merge($list, $this->_getMenuAutoCompleteList($menu["links"], $prefix . $menu['title'] . " -> "));
            }
        }

        return $list;
    }
}
