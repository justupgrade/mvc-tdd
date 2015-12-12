<?php

require_once 'app/libs/Bootstrap.php';
require_once 'app/libs/Controller.php';
require_once 'app/libs/Model.php';
require_once 'app/libs/View.php';

class ViewUnitTest extends PHPUnit_Framework_TestCase
{
    private $view = null;

    protected function setUp()
    {
        $this->view = new View();
    }

    public function testDummy()
    {

    }

}