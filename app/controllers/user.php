<?php

namespace controllers;
use Controller;
use Model;
use App;
use Session;

class User extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->view->page_title = 'Users';
        if(!App::userLoggedIn()) {
            $this->redirectUrl(URL);
        }
    }

    public function index()
    {
        $this->view->render('user/index');

        return true;
    }
}