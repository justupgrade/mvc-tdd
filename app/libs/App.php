<?php

class App
{
    static public function getModel($name)
    {
        require_once APP_DIR . 'model/' . "$name.php";
        $ClassName = "\\model\\".ucfirst($name);

        return new $ClassName;
    }
}