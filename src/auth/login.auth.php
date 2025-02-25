<?php

if (!isset($_POST['sign-up-btn'])) {
    header('Location: ../public/index.php');
    exit();
}

include_once __DIR__ . "/../../vendor/autoload.php";
include_once __DIR__ . "/../classes/Models/user.model.php";
require_once __DIR__ . "/../includes/handle_error.php";

$user = new User();

if (empty($_POST['signUpFullName']) || empty($_POST['signUpEmail']) || empty($_POST['signUpPassword'])) {
    error_message("Ensure all fields are filled correctly!!!");
} else {
    if ($user->createUser($_POST['signUpFullName'], $_POST['signUpEmail'], $_POST['signUpPassword'])) {
        success_message("Account created successfully!!!");
        echo '
        <script>
            setTimeout(() => {
                window.location.href = "../../public/index.php";
            }, 3000);
        </script>';
    } else {
        error_message("Failed to create account!!!");
        echo '
        <script>
            setTimeout(() => {
                window.location.href = "../../public/index.php";
            }, 3000);
        </script>';
    }
}
