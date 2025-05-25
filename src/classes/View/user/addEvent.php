<?php

include_once __DIR__ . '/../../Models/user.model.php';

if (isset($_POST['createEvent'])) {
    $user = new User();

    $title = $_POST['title'];
    $description = $_POST['description'];
    $venue = $_POST['venue'];
    $seats = $_POST['seats'];
    $user->insertEvent($title, $description, $venue, $seats);
    echo '<script>alert("Event added successfully!!!")</script>';
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Event</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">

    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">Add New Event</h1>

        <form action="" method="post" class="max-w-md mx-auto bg-white shadow rounded p-6">
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-bold mb-2">Title</label>
                <input type="text" id="title" name="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-bold mb-2">Description</label>
                <textarea id="description" name="description" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
            </div>

            <div class="mb-4">
                <label for="venue" class="block text-gray-700 font-bold mb-2">Venue</label>
                <input type="text" id="venue" name="venue" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label for="seats" class="block text-gray-700 font-bold mb-2">Available Seats</label>
                <input type="number" id="seats" name="seats" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="flex justify-end">
                <button type="submit" name="createEvent" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Event</button>
            </div>
        </form>

    </div>

</body>

</html>