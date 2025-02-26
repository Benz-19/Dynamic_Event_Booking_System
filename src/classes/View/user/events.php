<?php
session_start(); // Start the session at the very beginning

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "book_events";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch events (improved query to handle sold-out events efficiently)
$sql = "SELECT * FROM events WHERE date >= CURDATE() ORDER BY date ASC";
$result = $conn->query($sql);

// ... HTML structure (using Tailwind CSS for styling) ...
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Events</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .event-card {
            @apply bg-white rounded-lg shadow-md p-6 mb-4;
            /* Tailwind classes for styling */
        }

        .sold-out {
            @apply text-red-500 font-bold;
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">Upcoming Events</h1>

        <?php if ($result->num_rows > 0) : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4"> <?php // Grid for responsive layout 
                                                                                ?>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <div class="event-card">
                        <h3 class="text-xl font-semibold mb-2"><?php echo $row['title']; ?></h3>
                        <p class="mb-1">Date: <?php echo $row['date']; ?></p>
                        <p class="mb-1">Venue: <?php echo $row['venue']; ?></p>
                        <p class="mb-2"><?php echo $row['description']; ?></p>
                        <?php if ($row['available_seats'] > 0) : ?>
                            <button class="register-btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" data-event-id="<?php echo $row['id']; ?>">Register</button>
                        <?php else : ?>
                            <p class="sold-out">Sold Out</p>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <p class="text-center">No upcoming events.</p>
        <?php endif; ?>
    </div>


    <script>
        const registerButtons = document.querySelectorAll('.register-btn');

        registerButtons.forEach(button => {
            button.addEventListener('click', () => {
                const eventId = button.dataset.eventId;

                fetch('register_event.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: 'event_id=' + eventId
                    })
                    .then(response => response.text())
                    .then(data => {
                        alert(data); // Display the message from register_event.php
                        if (data === "Registration successful!") {
                            location.reload(); // Only reload on successful registration
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert("An error occurred. Please try again later."); // User-friendly error message
                    });
            });
        });
    </script>

</body>

</html>