<?php
session_start();

if (!isset($_POST['sign-up-btn'])) {
    header('Location: ../public/index.php');
    exit();
}

include_once __DIR__ . "/../../vendor/autoload.php";
include_once __DIR__ . "/../classes/Models/user.model.php";
require_once __DIR__ . "/../includes/handle_error.php";

$user = new User(); //new user instance

if (empty($_POST['signUpFullName']) || empty($_POST['signUpEmail']) || empty($_POST['signUpPassword']) || $_SESSION['user_role']) {
    error_message("Ensure all fields are filled correctly!!!");
} else {
    if ($user->createUser($_POST['signUpFullName'], $_POST['signUpEmail'], $_POST['signUpPassword'], $_SESSION['user_role'])) {
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
