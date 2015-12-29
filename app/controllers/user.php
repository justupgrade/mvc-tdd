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

        $this->view->js = array('user/js/index.js');
    }

    public function index()
    {
        $this->view->users = App::getModel('login')->getUsers();
        $this->view->render('user/index');
    }

    public function create()
    {
        $model = App::getModel('login');
        # validate request data
        $model->init($this->request->getPost());
        $response = array();

        if($model->register()) {
            $response['msg'] = 'Success';
        } else {
            $response['msg'] = 'Error';
            $response['error'] = 'Could not register';
        }

        echo json_encode($response);
    }

    public function edit()
    {

    }

    public function delete($id)
    {
        $response = array();

        if($this->request->isAjax()) {
            $model = App::getModel('login');
            if($model->deleteById($id)) {
                $response['msg'] = 'Success';
            } else {
                $response['msg'] = 'Error';
                $response['error'] = 'Could not delete user!';
            }

        } else {
            $response['msg'] = 'Error';
            $response['error'] = 'Ugly Hacker!!!';
        }

        echo json_encode($response);

    }
}