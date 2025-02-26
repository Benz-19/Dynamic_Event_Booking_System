<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">

    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4 text-center">Event Management Dashboard</h1>

        <div class="flex justify-center grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-60">
            <div class="bg-white shadow rounded p-4">
                <h2 class="text-xl font-semibold mb-2">Create Event</h2>
                <button id="createEventBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <a href="addEvent.php"> Create New Event</a>
                </button>
            </div>

            <div class="bg-white shadow rounded p-4">
                <h2 class="text-xl font-semibold mb-2">View Bookings</h2>
                <button id="viewBookingsBtn" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    <a href="viewBookings.php">View Bookings</a>
                </button>
            </div>

            <div class="bg-white shadow rounded p-4">
                <h2 class="text-xl font-semibold mb-2">View Events</h2>
                <button id="viewBookingsBtn" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    <a href="viewEvents.php">View Events</a>
                </button>
            </div>
        </div>


    </div>
</body>

</html>