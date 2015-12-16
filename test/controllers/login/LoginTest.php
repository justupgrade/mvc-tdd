<?php
/**
 * Created by PhpStorm.
 * User: tomasz
 * Date: 16.12.15
 * Time: 21:10
 */

namespace test\controllers\login;

use PHPUnit_Extensions_Selenium2TestCase;

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

    # loginPost action
    public function testLogin()
    {
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
} 