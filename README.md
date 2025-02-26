# Event Booking System

## Introduction
This Event Booking System is a web application that allows users to browse and register for events, and enables administrators to manage events and bookings.

## Features

**User Features:**

*   User registration and login (with email and password).
*   Browse available events.
*   Register for events (reduces available seats).
*   Cancel registrations (increases available seats).
*   "Sold Out" message for fully booked events.
*   View and manage bookings in a user dashboard.

**Admin Features:**

*   Create new events (title, date, description, venue, available seats).
*   Edit existing event details.
*   Delete events.
*   View bookings for each event.
*   Admin-specific dashboard.

## Installation

### Prerequisites

*   XAMPP (Apache, MySQL, PHP) or a similar web server environment.
*   Web browser.

### Steps

1.  Clone the repository: `git clone <repository_url>`
2.  Import the database:
    *   Create a new database in phpMyAdmin (e.g., `event_booking`).
    *   Import the `event_booking.sql` file (provided in the repository).
3.  Configure database connection:
    *   Edit `db.model.php` (or your database connection file) with your database credentials.
    ```php
    $host = "localhost";
    $dbname = "event_booking"; 
    $username = "your_username";
    $password = "your_password";
    ```

## Usage

1.  Access the application in your web browser (e.g., `http://localhost/Dynamic_Event_Booking_System/public/index.php`).
2.  Register a new account or log in.
3.  Browse events and register.
4.  Admins can access the admin dashboard (e.g., `http://localhost/Dynamic_Event_Booking_System/src/classes/View/admin/index.php`).

## Sample Create Account Credentials
*   **Admin User:**
    *   Name: `username`
    *   Email: `admin@example.com`
    *   Password: `adminpassword`
*   **Regular User:**
    *   Name: `username`
    *   Email: `user@example.com`
    *   Password: `userpassword`

## Sample Login Credentials

*   **Admin User:**
    *   Email: `admin@example.com`
    *   Password: `adminpassword`
*   **Regular User:**
    *   Email: `user@example.com`
    *   Password: `userpassword`

**Note:** Change these credentials after installation.

## Technologies Used

*   PHP
*   MySQL
*   HTML
*   CSS (with Tailwind CSS)
*   JavaScript (with AJAX/Fetch API)

## Security

*   Password hashing.
*   Prepared statements to prevent SQL injection.
*   Basic XSS protection.
*   Form validation (client-side and server-side).

## Contributing

Contributions are welcome! Fork the repository and submit a pull request.

## License

This project is licensed under the MIT License - see the LICENSE file for details.