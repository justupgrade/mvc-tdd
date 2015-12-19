<?php

class Dashboard extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->view->page_title = 'Dashboard';
    }

    public function index()
    {
        $this->view->render('dashboard/index');

        return true;
    }
}