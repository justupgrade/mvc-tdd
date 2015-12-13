<?php
/**
 * Created by PhpStorm.
 * User: tomasz
 * Date: 12.12.15
 * Time: 13:35
 */

class Login extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->view->page_title = 'Login';
    }

    # index action: render login form || redirect to user account if already logged in
    public function index()
    {
        App::getModel('login');
        # user not logged in
        $this->view->render('login/index');
    }

    # login action
    public function loginPost()
    {
        $model = App::getModel('login');
        $model->auth();
    }

    # display register form
    public function register()
    {
        $this->view->render('login/register');
    }

    # register action
    public function registerPost()
    {

    }
} 