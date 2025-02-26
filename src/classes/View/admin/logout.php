<?php
session_start();
include_once __DIR__ . "/../../Models/user.model.php";
include_once __DIR__ . "/../../../includes/handle_error.php";

$usr = new User();

$_SESSION['admin'] = NULL;

if ($usr->logoutUser()) {
    echo '
<script type="text/javascript">

    setTimeout(()=>{
    window.location.href = "index.php";
    }, 6000);
</script>
';
    // header("Location: index.php");
} else {
    error_message("Something went wrong.<br>Failed to logout...!");
}
