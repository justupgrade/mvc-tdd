<?php
/**
 * Created by PhpStorm.
 * User: tomasz
 * Date: 13.12.15
 * Time: 14:42
 */

require_once 'app/libs/App.php';

require_once 'app/libs/Bootstrap.php';
require_once 'app/libs/Controller.php';
require_once 'app/libs/Database.php';
require_once 'app/libs/Model.php';
require_once 'app/libs/View.php';

require_once 'app/config/database.php';
require_once 'app/config/paths.php';

class LoginIndexTest extends PHPUnit_Extensions_Selenium2TestCase
{
    protected function setUp()
    {
        $this->setBrowser('firefox');
        $this->setBrowserUrl('http://mvc.dev/');
    }

    public function testLoginForm()
    {
        $controller = 'login';
        $action = 'index';

        $this->url('http://mvc.dev/'.$controller.'/'.$action);

        $form = $this->byId('login-form');
        $this->assertNotNull($form);

        # form action

        # check values
        $email = $this->byName('email');
        $password = $this->byName('password');
    }

    # register form rendered?
    public function testRegisterFormLoaded()
    {
        $controller = 'login';
        $action = 'register';

        $this->url('http://mvc.dev/'.$controller.'/'.$action);

        $form = $this->byId('register-form');
        $this->assertNotNull($form);

        # check values
        $email = $this->byName('email');
        $password = $this->byName('password');
        $password_repeat = $this->byName('password_repeat');
    }
} 