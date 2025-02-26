<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "book_events";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if event ID is provided in the URL
if (isset($_GET['id'])) {
    $event_id = (int) $_GET['id']; // Sanitize the input

    if (isset($_POST['confirm_cancel'])) {
        header("Location:viewBookings.php");
        exit();
    }

    // Handle delete confirmation
    if (isset($_POST['confirm_delete'])) {
        $delete_sql = "DELETE FROM bookings WHERE id = $event_id";

        if ($conn->query($delete_sql) === TRUE) {
            echo "Event deleted successfully";
            header("Location:viewBookings.php");
            exit(); // Stop further execution
        } else {
            echo "Error deleting event: " . $conn->error;
        }
    }

    // Fetch event details for confirmation message
    $event_details_sql = "SELECT user_id FROM bookings WHERE id = $event_id";
    $event_details_result = $conn->query($event_details_sql);

    if ($event_details_result->num_rows == 1) {
        $event_row = $event_details_result->fetch_assoc();
        $event_title = $event_row['user_id'];
    } else {
        $event_title = "Booking Not Found";
    }
} else {
    header("Location:viewBookings.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Event</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">

    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">Delete Event</h1>

        <p>Are you sure you want to delete the event "<?php echo htmlspecialchars($event_title); ?>"?</p>

        <form method="post" action="deleteBookings.php?id=<?php echo $event_id; ?>">
            <button type="submit" name="confirm_delete" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mr-2">Yes, Delete</button>
            <button type="submit" name="confirm_cancel" class="bg-gray-400 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded"> No, Cancel </button>
        </form>

    </div>

</body>

</html>