<?php
/**
 * Created by PhpStorm.
 * User: tomasz
 * Date: 12.12.15
 * Time: 11:56
 */

require_once 'test/bootstrap.php';

class ViewTest extends PHPUnit_Extensions_Selenium2TestCase
{
    const HEADER_ID = 'header';
    const FOOTER_ID = 'footer';

    protected function setUp()
    {
        $this->setBrowser('firefox');
        $this->setBrowserUrl('http://mvc.dev/');
    }

    public function testIncludedHeaderAndFooter()
    {
        # find out if header is included on all pages :: selenium
        $controllers = ["index", "help", "error"];

        foreach($controllers as $controller) {
            # go to index action of every controller
            $this->url('http://mvc.dev/'.$controller);
            # findout if there is element with header id:
            $this->assertNotNull($this->byId(self::HEADER_ID), "Header not found!");
            $this->assertNotNull($this->byId(self::FOOTER_ID), "Footer not found!");
        }
    }
} 