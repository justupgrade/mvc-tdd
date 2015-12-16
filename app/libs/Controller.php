<?php
/**
 * Created by PhpStorm.
 * User: tomasz
 * Date: 11.12.15
 * Time: 18:35
 */

class Controller
{
    function __construct()
    {
        $this->view = new View();
    }

    protected function redirectUrl($location)
    {
        header('Location: ' . $location);
        exit;
    }
} 