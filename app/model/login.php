<?php

namespace model;

use Model;

class Login extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function auth()
    {
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $password = isset($_POST['password']) ? $_POST['password'] : null;

        $email = filter_var($email, FILTER_VALIDATE_EMAIL);

        if($email && $password) {
            $stmt = self::$pdo->prepare("SELECT * FROM users WHERE email=:email");
            $stmt->execute(array(
                ':email'    => $email,
            ));

            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            if($data) {
                $hashed = $data[0]['password'];
                if(password_verify($password, $hashed)) {
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
}