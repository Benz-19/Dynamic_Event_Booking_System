<?php
include_once __DIR__ . '/db.model.php';

class User extends Database
{

    public function createUser($name, $email, $password, $role)
    {
        try {
            $sql = "INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)";
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
                    ':password' => $hashedPassword,
                    ':role' => $role
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
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->Connection()->prepare($query);
        $stmt->execute([':email' => $email]); // Execute the query

        $row = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the result

        if ($row) {
            if (password_verify($password, $row['password'])) {
                return true; // Password matches
            } else {
                return false;
            }
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

    public function logoutUser()
    {
        // Destroy the session to log out the user
        session_unset();
        session_destroy();
        return true;
    }

    // getter
    public function getUserRole($email)
    {
        $query = "SELECT role FROM users WHERE email = :email";
        $stmt = $this->Connection()->prepare($query);
        $stmt->execute([':email' => $email]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return $row['role'];
        }

        return false;
    }


    public function getUserId($email)
    {
        $query = "SELECT id FROM users WHERE email = :email";
        $stmt = $this->Connection()->prepare($query);
        $stmt->execute([':email' => $email]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return $row['id'];
        }

        return false;
    }

    public function insertEvent($name, $description, $venue, $available_seats)
    {
        $query = "INSERT INTO events (name, description, venue, available_seats) VALUES (:name, :description, :venue, :available_seats)";
        $stmt = $this->Connection()->prepare($query);
        $stmt->execute([':name' => $name, ':description' => $description, ':venue' => $venue, ':available_seats' => $available_seats]);
    }
}
