<?php

namespace model;
use Model;

class User extends Model
{
    private $email = null;
    private $password = null;

    function __construct()
    {

    }

    public function init($email, $pass)
    {
        $this->email = $email;
        $this->password = $pass;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }
}