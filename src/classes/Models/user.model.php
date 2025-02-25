<?php


include_once __DIR__ . '/db.model.php';

class User extends Database
{

    public function createUser($name, $email, $password)
    {
        try {
            $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
            $stmt = $this->Connection()->prepare($sql);
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Validate if the user already exists
            $userExists = $this->validateUser($email);
            if ($userExists) {
                echo "User already exists!!!";
                return false;
            } else {
                $stmt->execute([
                    ':name' => $name,
                    ':email' => $email,
                    ':password' => $hashedPassword
                ]);
                return true;
            }
        } catch (PDOException $error) {
            echo "Error: Failed to create a new user!!!<br>" . $error->getMessage();
            return false;
        }
    }

    public function LoginUser($email, $password)
    {
        $query = "SELECT password FROM users WHERE email = :email";
        $stmt = $this->Connection()->prepare($query);
        $stmt->execute([':email' => $email]); // Execute the query

        $row = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the result

        if ($row) {
            return password_verify($password, $row['password']);
        }

        return false;
    }

    public function validateUser($email)
    {
        $query = "SELECT email FROM users WHERE email = :email";
        $stmt = $this->Connection()->prepare($query);
        $stmt->execute([':email' => $email]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return true;
        }

        return false;
    }
}
