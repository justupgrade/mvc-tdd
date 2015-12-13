<?php
/**
 * Created by PhpStorm.
 * User: tomasz
 * Date: 11.12.15
 * Time: 19:13
 */

class Model extends Database
{
    function __construct()
    {
        parent::__construct();
    }

    protected  function getHashedPassword($password) {
        $options = array(
            'cost' => 5,
            'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)
        );
        return password_hash($password, PASSWORD_BCRYPT, $options);
    }
} 