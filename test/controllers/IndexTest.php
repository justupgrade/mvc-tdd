<?php
/**
 * Created by PhpStorm.
 * User: tomasz
 * Date: 11.12.15
 * Time: 16:16
 */

require_once 'app/libs/Bootstrap.php';
require_once 'app/libs/Controller.php';
require_once 'app/libs/Model.php';
require_once 'app/libs/View.php';

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
    }

    //public function test
} 