<?php

class Bootstrap
{
    function __construct()
    {
        # defaults:
        $controller_name = 'index';
        $controller_action = 'index';
        $action_args = null;

        if(isset($_GET['url']) &&  !empty($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = explode('/', $url);

            //print_r($url);
            //echo '<hr>';

            $controller_name = $url[0];

            if(isset($url[1])) {
                $controller_action = $url[1];

                if(isset($url[2])) {
                    $action_args = $url[2];
                }
            }
        }

        $file = 'controllers/' . $controller_name . '.php';

        if(file_exists($file)) {
            require_once "$file";
            $controller = new $controller_name;
            if (method_exists($controller, $controller_action)) {
                $controller->{$controller_action}($action_args);
                return false;
            }
        }

        require_once 'controllers/error.php';
        (new Error())->index();
        return false;
    }
}