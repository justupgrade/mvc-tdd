<?php
/**
 * Created by PhpStorm.
 * User: tomasz
 * Date: 11.12.15
 * Time: 17:52
 */

class Index extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->view->page_title = 'MVC';
    }

    public function index($args = null)
    {
        $this->view->render('index/index');

        return true;
    }

    public function test()
    {
    }
} 