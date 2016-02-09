<?php


class Route
{
    static function start()
    {

        $controller_name = 'Main'; // controller by default
        $action_name = 'index'; // action by default

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        // gets controller name
        if (!empty($routes[2])) {
            $controller_name = $routes[2];
        }

        // gets action name
        if (!empty($routes[3])) {
            $action_name = $routes[3];
        }


        // prefix adding
        $model_name = 'Model_' . $controller_name;
        $controller_name = 'Controller_' . $controller_name;
        $action_name = 'action_' . $action_name;

        // gets model file (if exists)
        $model_file = strtolower($model_name) . '.php';
        $model_path = "models/" . $model_file;
        if (file_exists($model_path)) {
            include "models/" . $model_file;
        }

        // gets controller file (if exists)
        $controller_file = strtolower($controller_name) . '.php';
        $controller_path = "controllers/" . $controller_file;
        if (file_exists($controller_path)) {
            include "controllers/" . $controller_file;
        } else {
            Route::ErrorPage404();
        }

        // creates a controller
        $controller = new $controller_name;
        $action = $action_name;

        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            Route::ErrorPage404();
        }

    }

    function ErrorPage404()
    {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
    }

}
