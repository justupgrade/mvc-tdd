<?php
/**
 * Created by PhpStorm.
 * User: tomasz
 * Date: 12.12.15
 * Time: 13:35
 */

class Login extends Controller
{
    const LOGIN_REDIRECT_URL = URL;

    function __construct()
    {
        parent::__construct();
        $this->view->page_title = 'Login';
    }

    # index action: render login form || redirect to user account if already logged in
    public function index()
    {
        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
            $this->redirectUrl(self::LOGIN_REDIRECT_URL);
        }

        App::getModel('login');
        # user not logged in
        $this->view->render('login/index');
    }

    # login action
    public function loginPost()
    {
        $model = App::getModel('login');
        # validate request data
        $model->init($_POST);
        # auth
        if($model->auth()) { # successful login
            # login user
            $_SESSION['logged_in'] = true;
            # redirect
            $this->redirectUrl(self::LOGIN_REDIRECT_URL);
        }

        # get errors from model; put them into session
        $this->redirectUrl(URL.'login');
    }

    # display register form
    public function register()
    {
        $this->view->page_title = 'Create Account';
        $this->view->render('login/register');
    }

    # register action
    public function registerPost()
    {
        $model = App::getModel('login');
        # validate request data
        $model->init($_POST);
        if($model->register()) {
            $this->redirectUrl(URL.'login');
        }

        $this->redirectUrl(URL.'login/register');
    }

    # TODO:: only if user is logged in
    # TODO:: password protected
    public function deletePost()
    {
        $model = App::getModel('login');

        $model->init($_POST);

        if($model->delete()) {
            unset($_SESSION['logged_in']);
            $this->redirectUrl(URL);
        }

        //display errors...
        $this->redirectUrl(URL.'help');
    }
} 