<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "book_events";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all bookings
$sql = "SELECT * FROM events";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Events</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">

    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">All Events</h1>

        <?php if ($result->num_rows > 0) : ?>
            <table class="min-w-full divide-y divide-gray-200 border">
                <thead>
                    <tr>
                        <?php
                        // Get column names from the result set
                        $fields = $result->fetch_fields();
                        foreach ($fields as $field) :
                        ?>
                            <th class="pr-20 py-2"><?php echo $field->name; ?></th>
                        <?php endforeach; ?>
                        <th class="pr-12 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <?php foreach ($row as $value) : ?>
                                <td class="px-8 py-2"><?php echo $value; ?></td>
                            <?php endforeach; ?>
                            <td class="pr-12 py-2">
                                <a href="updateEvent.php?id=<?php echo $row['id']; ?>" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mr-2">Edit</a>
                                <a href="deleteEvent.php?id=<?php echo $row['id']; ?>" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>No bookings found.</p>
        <?php endif; ?>

    </div>

</body>

</html>