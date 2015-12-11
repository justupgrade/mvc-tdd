<?php
/**
 * Created by PhpStorm.
 * User: tomasz
 * Date: 11.12.15
 * Time: 18:04
 */

class Help extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->view->page_title = 'Help';
    }

    public function index()
    {
        $this->view->render('help/index');
    }
} 