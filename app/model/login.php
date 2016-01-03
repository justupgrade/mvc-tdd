<?php

namespace model;

use App;
use Model;

class Login extends Model
{
    private $user = null;
    private $errors = null;

    function __construct()
    {
        parent::__construct();

        App::loadModel('user');
    }

    public  function getUsers()
    {
        $stmt = self::$pdo->prepare("SELECT * FROM users");
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function init($data)
    {
        return $this->filterPost($data);
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
                    $this->user->setRole($data[0]['role']);
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
                $role = 'default';
                if($user_role = $this->user->getRole()) $role = $user_role;
                $stmt = self::$pdo->prepare("INSERT INTO users (email, password, role) VALUES (:email, :password, :role)");
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $this->getHashedPassword($pass));
                $stmt->bindParam(':role', $role);
                $stmt->execute();

                return true;
            }
        }

        return null;
    }

    public function update($id)
    {
        $stmt = self::$pdo->prepare("SELECT * FROM users WHERE id!=:id AND email=:email");
        $stmt->execute(array(
            ':email'    => $this->user->getEmail(),
            ':id'       => $id,
        ));

        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if(!$data) {
            $sql = "UPDATE users SET email=:email, role=:role WHERE id=:id";
            $stmt = self::$pdo->prepare($sql);
            $stmt->execute(array(
                ':email'    => $this->user->getEmail(),
                ':role'     => $this->user->getRole(),
                ':id'       => $id,
            ));

            return true;
        }

        return false;
    }

    # udpate email

    public function updateEmail($user)
    {
        $this->user = $user;

        $sql = "UPDATE users SET email=:email WHERE id=:id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute(array(
            ':email'    => $this->user->getEmail(),
            ':id'       => $this->user->getId(),
        ));
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

    public function deleteById($id)
    {
        if($id && $id != '1') {
            $sql = "DELETE FROM users WHERE id = :id";
            $stmt = self::$pdo->prepare($sql);
            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } else {
            $this->errors = array();
            $this->errors[] = "Can not delete owner!";
        }

        return null;
    }

    private function filterPost($data)
    {
        $email = User::FilterEmail($data['email']);
        $password = isset($data['password']) ? $data['password'] : null;
        $role = isset($data['roles']) ? $data['roles'] : 'default';

        if(!in_array($role, ['default', 'admin', 'owner'])) $role = 'default';

        $this->user = App::getModel('user')->init(null, $email, $password);
        $this->user->setRole($role);

        if(strlen(trim($password)) < 3){
            $this->errors = ['Password is too short.'];
            return false;
        }

        return true;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}