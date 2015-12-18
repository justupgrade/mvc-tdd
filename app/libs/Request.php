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
} 