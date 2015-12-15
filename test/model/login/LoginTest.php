<?php
/**
 * Created by PhpStorm.
 * User: tomasz
 * Date: 13.12.15
 * Time: 17:43
 */

require_once 'test/bootstrap.php';

class LoginTest extends PHPUnit_Extensions_Database_TestCase
{
    private $model = null;
    private $conn = null;

    public function getConnection()
    {
        $config = parse_ini_file(ROOT_DIR.'../config.ini');

        $this->conn = new PDO(
            $GLOBALS['DB_DSN'],
            $config['username'],
            $config['password']
        );

        return new PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection($this->conn, $GLOBALS['DB_NAME']);
    }

    public function getDataSet()
    {
        return new PHPUnit_Extensions_Database_DataSet_YamlDataSet(ROOT_DIR.'test/data/login/data.yml');
    }

    public function setUp()
    {
        $this->model = App::getModel('login');
    }

    //TODO: create request object
    //todo::check error array for specified messages
    public function testLoginPostValidData()
    {
        #1: invalidEmail & invalidPassword
        $_POST['email'] = '';
        $_POST['password'] = '';
        $this->model->init($_POST);
        $this->assertNull($this->model->auth());
        #2: invalidEmail
        $_POST['email'] = 'test';
        $_POST['password'] = 'pass';
        $this->model->init($_POST);
        $this->assertNull($this->model->auth());
        #3: invalidPassword
        $_POST['email'] = 'test@test.com';
        $_POST['password'] = '';
        $this->model->init($_POST);
        $this->assertNull($this->model->auth());
        #4: validPassword & valid email
        $_POST['email'] = 'test@test.com';
        $_POST['password'] = '123';
        $this->model->init($_POST);
        $this->assertNotNull($this->model->auth());
    }

    #check against db
    public function testLoginPost()
    {
        # no user in db
        $_POST['email'] = 'not.a.user@test.com';
        $_POST['password'] = '123';
        $this->model->init($_POST);
        $this->assertNull($this->model->auth());
        # user exists but wrong password
        $_POST['email'] = 'test@test.com';
        $_POST['password'] = 'wrong_pass';
        $this->model->init($_POST);
        $this->assertNull($this->model->auth());
        # user exists and good password
        $_POST['email'] = 'test@test.com';
        $_POST['password'] = '123';
        $this->model->init($_POST);
        $this->assertNotNull($this->model->auth());
        # another good combo
        $_POST['email'] = 'another@test.com';
        $_POST['password'] = 'pass';
       // $this->assertNotNull($this->model->auth());
    }

    public function testRegisterUser()
    {
        # call register action
        #1: invalidEmail & invalidPassword
        $_POST['email'] = '';
        $_POST['password'] = '';
        $this->model->init($_POST);
        $this->assertNull($this->model->register());
        #2: invalidEmail
        $_POST['email'] = 'test';
        $_POST['password'] = 'pass';
        $this->model->init($_POST);
        $this->assertNull($this->model->register());
        #3: invalidPassword
        $_POST['email'] = 'test@test.com';
        $_POST['password'] = '';
        $this->model->init($_POST);
        $this->assertNull($this->model->register());
        #4: user not unique
        $_POST['email'] = 'test@test.com';
        $_POST['password'] = '123';
        $this->model->init($_POST);
        $this->assertNull($this->model->register());
        #5: add user & delete after to clean up
        $_POST['email'] = 'another@test.com';
        $_POST['password'] = 'pass';
        $this->model->init($_POST);
        $this->assertTrue($this->model->register());
        $this->assertTrue($this->model->auth());
        $this->assertTrue($this->model->delete());
    }
} 