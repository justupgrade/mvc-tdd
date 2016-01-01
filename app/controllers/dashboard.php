<?php

use model\User as User;

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

    # update user data: ajax call
    public function changeEmailAjax()
    {
        # some validation...
        $new_email = User::FilterEmail($this->request->getPost()['new_email']);
        $response = array();

        if($new_email) {
            $user = Session::get('user');
            $old_email = $user->getEmail();
            $user->setEmail($new_email);

            $model = App::getModel('login');
            $model->setUser($user);
            if($model->update($user->getId())) {
                $response['msg'] = 'Success';
            } else {
                $response['msg'] = 'Error';
                $response['error'] = 'Could not update user!';
                $user->setEmail($old_email);
            }
            Session::set('user', $user);
        } else {
            $response['msg'] = 'Error';
        }

        echo json_encode($response);
    }
}