<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "book_events";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if event ID is provided in the URL
if (isset($_GET['id'])) {
    $event_id = $_GET['id'];

    // Fetch event details from the database
    $sql = "SELECT * FROM bookings WHERE id = $event_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];
        $event_id = $row['event_id'];
        $booking_date = $row['booking_date'];
    } else {
        echo "Event not found.";
        exit();
    }
} else {
    // echo "Event ID is missing.";
    header("Location: Bookings.php");
    exit();
}

// Handle form submission
if (isset($_POST['updateInfo'])) {
    $user_id = $_POST['user_id'];
    $event_id = $_POST['event_id'];
    $booking_date = $_POST['booking_date'];


    // SQL query to update event details
    $update_sql = "UPDATE bookings SET 
                   user_id = '$user_id',
                   event_id = '$event_id',
                     booking_date = '$booking_date'
                     WHERE id = $event_id";

    if ($conn->query($update_sql) === TRUE) {
        echo "Event updated successfully";
        header("Location: Bookings.php");
    } else {
        echo "Error updating event: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">

    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">Edit Event</h1>

        <form action="updateBookings.php?id=<?php echo $event_id; ?>" method="post" class="max-w-md mx-auto bg-white shadow rounded p-6">
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-bold mb-2">User Id</label>
                <input type="text" id="title" name="user_id" value="<?php echo $user_id; ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label for="date" class="block text-gray-700 font-bold mb-2">Event Id</label>
                <input type="text" id="date" name="event_id" value="<?php echo $event_id; ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-bold mb-2">Booking Date</label>
                <i><?php echo "Previous Date: " . $booking_date; ?></i>
                <input type="date" id="description" name="booking_date" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></input>
            </div>

            <div class="flex justify-end">
                <button type="submit" name="updateInfo" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Event</button>
            </div>
        </form>

    </div>

</body>

</html>