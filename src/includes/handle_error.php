<?php

function success_message($msg)
{
    echo '<div class="success">' . $msg . '</div>';
}

function error_message($msg)
{
    echo '<div class="error">' . $msg . '</div>';
}
?>

<style>
    .error {
        background-color: #f44336;
        color: white;
        padding: 1em;
        margin: 1em 0;
        border-radius: 5px;
        text-align: center;
    }

    .success {
        background-color: #4CAF50;
        color: white;
        padding: 1em;
        margin: 1em 0;
        border-radius: 5px;
        text-align: center;
    }
</style>

<script>
    const error = document.getElementsByClassName('error')[0];
    const success = document.getElementsByClassName('success')[0];

    if (error) {
        setTimeout(() => {
            error.style.display = 'none';
        }, 3000);
    }

    if (success) {
        setTimeout(() => {
            success.style.display = 'none';
        }, 3000);
    }
</script>