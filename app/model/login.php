<?php

namespace model;

use App;
use Model;

class Login extends Model
{
    private $user = null;

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
        if(($email = $this->user->getEmail()) && ($pass = $this->user->getPassword())) {
            $stmt = self::$pdo->prepare("SELECT * FROM users WHERE email=:email");
            $stmt->execute(array(
                ':email'    => $email,
            ));

            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            if($data) {
                $hashed = $data[0]['password'];
                if(password_verify($pass, $hashed)) {
                    $this->user->setId($data[0]['id']);
                    return $this->user;
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
        if(($email = $this->user->getEmail()) && ($pass = $this->user->getPassword())) {
            $stmt = self::$pdo->prepare("SELECT * FROM users WHERE email=:email");
            $stmt->execute(array(
                ':email'    => $email,
            ));

            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if(!$data) {
                $stmt = self::$pdo->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $this->getHashedPassword($pass));
                $stmt->execute();

                return true;
            }
        }

        return null;
    }

    public function delete()
    {
        if($email = $this->user->getEmail()) {
            $sql = "DELETE FROM users WHERE email = :email";
            $stmt = self::$pdo->prepare($sql);
            $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
            $stmt->execute();

            return true;
        }

        return null;
    }

    private function filterPost($data)
    {
        $email = User::FilterEmail($data['email']);
        $password = isset($data['password']) ? $data['password'] : null;

        $this->user = App::getModel('user')->init(null, $email, $password);
    }
}