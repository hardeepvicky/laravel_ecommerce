<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Menu;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class BackendController extends WebController
{
    public $menus = [];

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

        $current_route_name = Route::currentRouteName();

        Menu::setCurrentRouteName($current_route_name);

        $menus = Menu::get(Auth::user()->id);

        $header_menu_list = Menu::getList($menus);

        $common_elements_path = "backend.common_elements";

        $breadcums = Menu::getBreadcums($menus);

        $this->setForView(compact("current_route_name", "menus", "header_menu_list", "common_elements_path", "breadcums"));
    }
}
