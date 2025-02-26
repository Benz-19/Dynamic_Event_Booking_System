<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "book_events";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

include_once __DIR__ . "/../../Models/user.model.php";
$user = new User();
$id = $user->getUserId($_SESSION['user']);
if (!isset($id)) {
    echo "You must login first";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_id = $_POST['event_id'];
    $user_id = $id;

    // Use prepared statements to prevent SQL injection
    $check_sql = "SELECT available_seats FROM events WHERE id = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("i", $event_id); // "i" for integer
    $stmt->execute();
    $stmt->bind_result($available_seats);
    $stmt->fetch();
    $stmt->close();


    if ($available_seats > 0) {
        $insert_sql = "INSERT INTO bookings (user_id, event_id) VALUES (?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("ii", $user_id, $event_id); // "ii" for two integers

        if ($insert_stmt->execute()) {
            $update_sql = "UPDATE events SET available_seats = available_seats - 1 WHERE id = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("i", $event_id);
            $update_stmt->execute();
            $update_stmt->close();
            $insert_stmt->close();
            echo "Registration successful!";
        } else {
            echo "Error registering: " . $insert_stmt->error;
        }
    } else {
        echo "Event is sold out!";
    }
}

$conn->close();
