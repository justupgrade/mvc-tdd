<?php
/**
 * Created by PhpStorm.
 * User: tomasz
 * Date: 13.12.15
 * Time: 13:34
 */

class Database extends PDO
{
    static public $pdo = null;

    function __construct()
    {
        $config = parse_ini_file(ROOT_DIR.'../config.ini');
        parent::__construct('mysql:host=localhost;dbname='.$config['dbname'], $config['username'], $config['password']);

        self::$pdo = $this;
    }
}