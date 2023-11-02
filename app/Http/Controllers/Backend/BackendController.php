<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Menu;
use App\Http\Controllers\WebController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BackendController extends WebController
{
    public function __construct()
    {
        parent::__construct();
        
        $request = request();

        if ( $request->ajax() ) {
            $this->layout = "backend.layouts.ajax";
        }
        else {
            $this->layout = "backend.layouts.backend";
        }
    }

    protected function beforeViewRender()
    {
        parent::beforeViewRender();

        $request = request();

        $current_route_name = $request->route()->getName();

        Menu::setCurrentRouteName($current_route_name);

        $menus = Menu::get(Auth::user()->id);

        $breadcums = Menu::getBreadcums($menus);

        $header_menu_list = Menu::getList($menus);

        $this->setForView(compact("current_route_name", "menus", "breadcums", "header_menu_list"));
    }
}
