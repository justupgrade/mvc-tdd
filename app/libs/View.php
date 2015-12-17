<?php
/**
 * Created by PhpStorm.
 * User: tomasz
 * Date: 11.12.15
 * Time: 18:44
 */

class View
{
    public $page_title = null;

    function __construct()
    {

    }

    public function render($name)
    {
        require_once 'view/header.php';
        require 'view/' . $name . '.php';
        require_once 'view/footer.php';
    }

    public function getRegisterUrl()
    {
        return App::getRegisterUrl();
    }

    public function getRegisterAction()
    {
        return App::getRegisterAction();
    }

    public function getLoginAction()
    {
        return App::getLoginAction();
    }
} 