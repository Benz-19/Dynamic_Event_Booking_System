<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
}

include_once __DIR__ . "/../../Models/user.model.php";
$user = new User();
$id = $user->getUserId($_SESSION['user']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">

    <div class="container mx-auto p-4 flex justify-end">
        <a href="logout.php" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Logout</a>
    </div>

    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">Welcome to Your Dashboard, <?php echo $_SESSION['user']; ?>!</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div class="bg-white shadow rounded p-4">
                <h2 class="text-xl font-semibold mb-2">Register Events</h2>
                <p>Register for upcoming events.</p>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4  mt-12 rounded">
                    <a href="addEvent.php">
                        View Events
                    </a>
                </button>
            </div>

            <div class="bg-white shadow rounded p-4">
                <h2 class="text-xl font-semibold mb-2">Browse Events</h2>
                <p>View upcoming events.</p>
                <button class="bg-yellow-500 hover:bg-blue-700 text-white font-bold py-2 px-4  mt-12 rounded">
                    <a href="events.php">
                        View Events
                    </a>
                </button>
            </div>

            <div class="bg-white shadow rounded p-4">
                <h2 class="text-xl font-semibold mb-2">My Bookings</h2>
                <p>View and manage your event registrations.</p>
                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 mt-12 rounded">
                    <a href="bookings.php?id=<?php echo $id; ?>">
                        View Bookings
                    </a>
                </button>
            </div>

        </div>
</body>

</html>