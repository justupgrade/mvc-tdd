<?php
/**
 * Created by PhpStorm.
 * User: tomasz
 * Date: 13.12.15
 * Time: 14:42
 */

require_once 'test/bootstrap.php';

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