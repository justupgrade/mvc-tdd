<?php

class Error extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->view->page_title = 'Error';
    }

    function index()
    {
        $this->view->render('error/index');
    }
}