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
        if(App::userLoggedIn()) {
            $this->redirectUrl(self::LOGIN_REDIRECT_URL);
        }

        App::getModel('login');
        # user not logged in
        $this->view->error_msg = Session::get('error_msg');
        Session::set('error_msg', null);
        $this->view->render('login/index');
    }

    # login action
    public function loginPost()
    {
        $model = App::getModel('login');
        # validate request data
        if($model->init($this->request->getPost())) {
            # auth
            if($user = $model->auth()) { # successful login
                # login user
                Session::set('logged_in', true);
                Session::set('user', $user);
                Session::set('role', $user->getRole());
                # redirect
                $this->redirectUrl(self::LOGIN_REDIRECT_URL);
            }
        }

        Session::set('error_msg', $this->getErrorsHtml($model->getErrors()));
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

    public function delete()
    {
        $this->view->page_title = 'Delete Account';
        $this->view->render('login/delete');
    }

    # TODO:: only if user is logged in
    # TODO:: password protected
    public function deletePost()
    {
        $model = App::getModel('login');

        $model->init($this->request->getPost());

        if($model->delete()) {
            Session::Clear();
            $this->redirectUrl(URL);
        }

        //display errors...
        $this->redirectUrl(URL.'help');
    }

    //TODO::add some messages
    public function out()
    {
        Session::Clear();

        $this->redirectUrl(URL);
    }
} 