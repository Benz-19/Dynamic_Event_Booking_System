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
    $sql = "SELECT * FROM events WHERE id = $event_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $title = $row['name'];
        $date = $row['date'];
        $description = $row['description'];
        $venue = $row['venue'];
        $seats = $row['available_seats'];
    } else {
        echo "Event not found.";
        exit();
    }
} else {
    // echo "Event ID is missing.";
    header("Location: viewEvents.php");
    exit();
}

// Handle form submission
if (isset($_POST['updateInfo'])) {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $description = $_POST['description'];
    $venue = $_POST['venue'];
    $seats = $_POST['seats'];

    // SQL query to update event details
    $update_sql = "UPDATE events SET 
                   name = '$title',
                   date = '$date',
                   description = '$description',
                   venue = '$venue',
                   available_seats = '$seats'
                   WHERE id = $event_id";

    if ($conn->query($update_sql) === TRUE) {
        echo "Event updated successfully";
        header("Location: viewEvents.php");
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

        <form action="updateEvent.php?id=<?php echo $event_id; ?>" method="post" class="max-w-md mx-auto bg-white shadow rounded p-6">
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-bold mb-2">Title</label>
                <input type="text" id="title" name="title" value="<?php echo $title; ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label for="date" class="block text-gray-700 font-bold mb-2">Date</label>
                <input type="date" id="date" name="date" value="<?php echo $date; ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-bold mb-2">Description</label>
                <textarea id="description" name="description" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required><?php echo $description; ?></textarea>
            </div>

            <div class="mb-4">
                <label for="venue" class="block text-gray-700 font-bold mb-2">Venue</label>
                <input type="text" id="venue" name="venue" value="<?php echo $venue; ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label for="seats" class="block text-gray-700 font-bold mb-2">Available Seats</label>
                <input type="number" id="seats" name="seats" value="<?php echo $seats; ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="flex justify-end">
                <button type="submit" name="updateInfo" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Event</button>
            </div>
        </form>

    </div>

</body>

</html>