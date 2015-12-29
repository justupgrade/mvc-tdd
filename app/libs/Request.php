<?php
/**
 * Created by PhpStorm.
 * User: tomasz
 * Date: 17.12.15
 * Time: 22:59
 */

class Request
{
    private $post = null;

    public function __construct()
    {
        $this->post = $_POST;
    }

    public function getPost()
    {
        return $this->post;
    }

    public function isAjax()
    {
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            return true;
        }

        return false;
    }
} 