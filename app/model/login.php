<?php

namespace model;

use Model;

class Login extends Model
{
    private $email = null;
    private $password = null;

    function __construct()
    {
        parent::__construct();
    }

    public function init($data)
    {
        $this->filterPost($data);
    }

    public function auth()
    {
        if($this->email && $this->password) {
            $stmt = self::$pdo->prepare("SELECT * FROM users WHERE email=:email");
            $stmt->execute(array(
                ':email'    => $this->email,
            ));

            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            if($data) {
                $hashed = $data[0]['password'];
                if(password_verify($this->password, $hashed)) {
                    return true;
                }
                else {
                   // trigger_error("ERROR! Wrong password: " . $password);
                }
            } else {
                //trigger_error('no data');
            }
        }

        return null;
    }

    //TODO:: RETURN NEW USER
    public function register()
    {
        if($this->email && $this->password) {
            $stmt = self::$pdo->prepare("SELECT * FROM users WHERE email=:email");
            $stmt->execute(array(
                ':email'    => $this->email,
            ));

            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if(!$data) {
                $stmt = self::$pdo->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
                $stmt->bindParam(':email', $this->email);
                $stmt->bindParam(':password', $this->getHashedPassword($this->password));
                $stmt->execute();

                return true;
            }
        }

        return null;
    }

    public function delete()
    {
        if($this->email) {
            $sql = "DELETE FROM users WHERE email = :email";
            $stmt = self::$pdo->prepare($sql);
            $stmt->bindParam(':email', $this->email, \PDO::PARAM_STR);
            $stmt->execute();

            return true;
        }

        return null;
    }

    private function filterPost($data)
    {
        $email = isset($data['email']) ? $data['email'] : null;
        $this->password = isset($data['password']) ? $data['password'] : null;

        $this->email = filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}