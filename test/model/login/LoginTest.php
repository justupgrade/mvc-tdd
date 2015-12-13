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
    private $pdo = null;

    public function getConnection()
    {
        $config = parse_ini_file(ROOT_DIR.'../config.ini');

        $conn = new PDO(
            $GLOBALS['DB_DSN'],
            $config['username'],
            $config['password']
        );

        $this->pdo = new PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection($conn, $GLOBALS['DB_NAME']);

        return $this->pdo;
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
        $this->assertNull($this->model->auth());
        #2: invalidEmail
        $_POST['email'] = 'test';
        $_POST['password'] = 'pass';
        $this->assertNull($this->model->auth());
        #3: invalidPassword
        $_POST['email'] = 'test@test.com';
        $_POST['password'] = '';
        $this->assertNull($this->model->auth());
        #4: validPassword & valid email
        $_POST['email'] = 'test@test.com';
        $_POST['password'] = '123';
        $this->assertNotNull($this->model->auth());
    }

    #check against db
    public function testLoginPost()
    {
        //\Database::$pdo = $this->pdo;
        # no user in db
        $_POST['email'] = 'not.a.user@test.com';
        $_POST['password'] = '123';
        $this->assertNull($this->model->auth());
        # user exists but wrong password
        $_POST['email'] = 'test@test.com';
        $_POST['password'] = 'wrong_pass';
        $this->assertNull($this->model->auth());
        # user exists and good password
        $_POST['email'] = 'test@test.com';
        $_POST['password'] = '123';
        $this->assertNotNull($this->model->auth());
        # another good combo
        $_POST['email'] = 'another@test.com';
        $_POST['password'] = 'pass';
       // $this->assertNotNull($this->model->auth());
    }
} 