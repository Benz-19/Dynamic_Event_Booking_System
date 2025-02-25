<?php

use PDOException;

require_once __DIR__ . '/../../../vendor/autoload.php';

class User extends Database
{

    public function createUser($name, $password, $email)
    {
        try {
            $sql = "INSERT INTO users (name, email, password) VALUES (:name, :password, :email)";
            $stmt = $this->Connection()->prepare($sql);
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt->execute([
                ':name' => $name,
                ':password' => $hashedPassword,
                ':email' => $email
            ]);
            return true;
        } catch (PDOException $error) {
            echo "Error: Failed to create a new user!!!<br>" . $error->getMessage();
            return false;
        }
    }

    public function LoginUser($email, $password)
    {
        $query = "SELECT password FROM users WHERE email = :email";
        $stmt =  $this->Connection()->prepare($query);
        $result  = $stmt->execute([':email' => $email]);
    }
}
