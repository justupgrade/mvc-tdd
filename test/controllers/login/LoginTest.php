<?php
/**
 * Created by PhpStorm.
 * User: tomasz
 * Date: 16.12.15
 * Time: 21:10
 */

namespace test\controllers\login;

use PHPUnit_Extensions_Selenium2TestCase;
use App;

require_once 'test/bootstrap.php';

class LoginTest extends PHPUnit_Extensions_Selenium2TestCase
{
    static public $browsers = array(
        array(
        'browserName' => 'firefox',
        'sessionStrategy' => 'shared',
        ),
    );

    protected function setUp()
    {
        $this->setBrowserUrl('http://mvc.dev/');
    }

    # registerPost action
    public function testRegister()
    {
        unset($_SESSION['logged_in']);
        $this->url(URL.'login/register');
        $this->assertEquals('Create Account', $this->title());

        $email_input = $this->byName('email');
        $pass_input = $this->byName('password');
        $repeat_input = $this->byName('password_repeat');
        $submit_input = $this->byName('register');

        $new_email = 'another@test.com';
        $new_pass = 'pass';

        $email_input->value($new_email);
        $pass_input->value($new_pass);
        $repeat_input->value($new_pass);
        $submit_input->submit();

        //check url
        $this->assertEquals(App::getLoginUrl(), $this->url());
        # login with new credentials
        $email_field = $this->byName('email');
        $pass_field = $this->byName('password');
        $submit = $this->byName('login');
        $email_field->value($new_email);
        $pass_field->value($new_pass);
        $submit->submit();
        $this->assertEquals('MVC', $this->title());

        # log out
        $this->url(URL.'login/out');
        $this->assertEquals('MVC', $this->title());
    }

    # loginPost action
    public function testLogin()
    {
        unset($_SESSION['logged_in']);
        $this->url(URL.'login');
        $this->assertEquals('Login', $this->title());
        $email_field = $this->byName('email');
        $pass_field = $this->byName('password');
        $submit = $this->byName('login');
        # valid data scenario:
        # expected: redirect to homepage
        $email_field->value("test@test.com");
        $pass_field->value("123");
        $submit->submit();

        $this->assertEquals('MVC', $this->title());
    }

    public function testDelete()
    {
        # delete new user:
        $email = 'another@test.com';
        $password = 'pass';
        $this->url(URL.'login/delete');
        $email_input = $this->byName('email');
        $pass_input = $this->byName('password');
        $submit_input = $this->byName('delete');
        $email_input->value($email);
        $pass_input->value($password);
        $submit_input->submit();
        #expect: redirect to homepage
        $this->assertEquals('MVC', $this->title());
    }
} 