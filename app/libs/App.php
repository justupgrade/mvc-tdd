<?php

session_start();

class App
{
    static public function getModel($name)
    {
        require_once APP_DIR . 'model/' . "$name.php";
        $ClassName = "\\model\\".ucfirst($name);

        return new $ClassName;
    }

    static public function userLoggedIn()
    {
        return (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) ? true : false;
    }

    static public function getRegisterUrl()
    {
        return URL."login/register";
    }

    static public function getRegisterAction()
    {
        return URL."login/registerPost";
    }

    static public function getLoginUrl()
    {
        return URL.'login';
    }

    static public function getLoginAction()
    {
        return URL."login/loginPost";
    }

    static public function getDeleteAction()
    {
        return URL.'login/deletePost';
    }
}