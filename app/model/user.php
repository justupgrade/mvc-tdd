<?php

namespace model;

class User
{
    private $email = null;
    private $password = null;
    private $id = null;

    function __construct()
    {

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