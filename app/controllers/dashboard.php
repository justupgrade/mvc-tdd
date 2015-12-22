<?php

class Dashboard extends Controller
{
    function __construct()
    {
        # import user definition
        App::loadModel('user');

        parent::__construct();
        $this->view->page_title = 'Dashboard';
        if(!App::userLoggedIn()) {
            $this->redirectUrl(URL);
        }

        $this->view->js = array('dashboard/js/default.js');
        $this->view->user = Session::get('user');
    }

    public function index()
    {
        $this->view->render('dashboard/index');

        return true;
    }

    public function changeEmailAjax()
    {

    }
}