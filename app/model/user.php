<?php

namespace model;
use Model;
use App;
use Session;

class User
{
    private $email = null;
    private $password = null;
    private $id = null;

    function __construct()
    {

    }

    static public function test()
    {
        echo 'test';
    }

    public function update()
    {
        App::getModel('login')->updateEmail($this);
        Session::set('user', $this);
    }

    static public function FilterEmail($_email)
    {
        $email = $_email ? $_email : null;
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function init($id, $email, $pass)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $pass;

        return $this;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getId()
    {
        return $this->id;
    }
}