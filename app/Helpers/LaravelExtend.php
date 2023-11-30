<?php

namespace App\Helpers;

class LaravelExtend
{
    public static function getRoutes()
    {
        $routeCollections = \Illuminate\Support\Facades\Route::getRoutes();

        $routes = [];
        foreach ($routeCollections as $routeObj) {

            $route = [
                'url' => $routeObj->uri,
                'route_name' => $routeObj->getName(),
                "action" => $routeObj->getActionName(),
                "name" => $routeObj->getName()
            ];

            $routes[] = $route;
        }

        //d($routes); exit;

        return $routes;
    }
}