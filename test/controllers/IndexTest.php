<?php
/**
 * Created by PhpStorm.
 * User: tomasz
 * Date: 11.12.15
 * Time: 16:16
 */

require_once 'test/bootstrap.php';

class IndexTest extends PHPUnit_Extensions_Selenium2TestCase
{
    protected function setUp()
    {
        $this->setBrowser('firefox');
        $this->setBrowserUrl('http://mvc.dev/');
    }

    public function testTitle()
    {
        # redirect to  homepage
        $this->url('http://mvc.dev/');
        $this->assertEquals('MVC', $this->title());
        $this->url('http://mvc.dev/index');
        $this->assertEquals('MVC', $this->title());
        $this->url('http://mvc.dev/index/index');
        $this->assertEquals('MVC', $this->title());
        $this->url('http://mvc.dev/index/index/12');
        $this->assertEquals('MVC', $this->title());
        # redirect to help page
        $this->url('http://mvc.dev/help/index');
        $this->assertEquals('Help', $this->title());
        $this->url('http://mvc.dev/help/');
        $this->assertEquals('Help', $this->title());
        # redirect to error page
        $this->url('http://mvc.dev/wrong/address');
        $this->assertEquals('Error', $this->title());
        $this->url('http://mvc.dev/index/wrong_action');
        $this->assertEquals('Error', $this->title());
        #redirect to login page
        $this->url('http://mvc.dev/login/index');
        $this->assertEquals('Login', $this->title());
        $this->url('http://mvc.dev/login/');
        $this->assertEquals('Login', $this->title());
    }

    //public function test
} 