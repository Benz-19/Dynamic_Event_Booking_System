<?php

include_once __DIR__ . "/../../Models/user.model.php";
include_once __DIR__ . "/../../../includes/handle_error.php";

$usr = new User();

if ($usr->logoutUser()) {
    header("Location: index.php");
} else {
    error_message("Something went wrong.<br>Failed to logout...!");
}
