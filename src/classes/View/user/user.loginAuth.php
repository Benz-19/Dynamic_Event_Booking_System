<?php
session_start();



include_once __DIR__ . "/../../../../vendor/autoload.php";
include_once __DIR__ . "/../../Models/user.model.php";
require_once __DIR__ . "/../../../includes/handle_error.php";

$user = new User(); //new user instance

if (isset($_POST['sign-up-btn'])) {
    if (empty($_POST['signUpFullName']) || empty($_POST['signUpEmail']) || empty($_POST['signUpPassword'])) {
        error_message("Ensure all fields are filled correctly!!!");
        echo '
    <script>
        setTimeout(() => {
            window.location.href = "index.php"; //redirect to user login page 
        }, 3000);
    </script>';
    } else {
        if ($user->createUser($_POST['signUpFullName'], $_POST['signUpEmail'], $_POST['signUpPassword'], 'user')) {
            success_message("Account created successfully!!!");
            echo '
        <script>
            setTimeout(() => {
                window.location.href = "index.php"; //redirect to user login page 
            }, 3000);
        </script>';
        } else {
            error_message("Failed to create account!!!");
            echo '
        <script>
            setTimeout(() => {
                window.location.href = "index.php"; //redirect to user login page 
            }, 3000);
        </script>';
        }
    }
} else {
    // Login user
    if (isset($_POST['sign-in-btn'])) {
        if (empty($_POST['signInEmail']) || empty($_POST['signInPassword'])) {
            error_message("Ensure all fields are filled correctly!!!");
            echo '
        <script>
            setTimeout(() => {
                window.location.href = "index.php"; //redirect to user login page 
            }, 3000);
        </script>';
        } else {

            $email = $_POST['signInEmail'];
            $password = $_POST['signInPassword'];

            if ($user->LoginUser($email, $password)) {
                $_SESSION['admin'] = $email;
                header('Location: dashboard.php');
            } else {
                error_message("Invalid email or password!!!");
                echo '
                <script>
                    setTimeout(() => {
                        window.location.href = "index.php"; //redirect to user login page 
                    }, 3000);
                </script>';
            }
        }
    }
}
