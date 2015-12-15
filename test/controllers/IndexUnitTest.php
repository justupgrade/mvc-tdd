<?php
/**
 * Created by PhpStorm.
 * User: tomasz
 * Date: 11.12.15
 * Time: 17:39
 */

require_once 'test/bootstrap.php';

require_once 'app/controllers/index.php';

class IndexUnitTest extends PHPUnit_Framework_TestCase
{
    private $indexController = null;

    protected function setUp()
    {
        $this->indexController = new Index();
    }

    public function testIndex()
    {
        $this->assertNotNull($this->indexController);
        #index action: load index view
        //$indexContent = $this->indexController->index();
        $this->assertNotNull($this->indexController->view);
        $this->assertEquals('MVC', $this->indexController->view->page_title);
    }
}

