<?php
// Check if the form has been submitted
if (isset($_POST["send"])) {
    // Database connection details
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'book_db';

    // Create a connection to the database
    $connection = mysqli_connect($hostname, $username, $password, $dbname);

    // Check if the connection was successful
    if (!$connection) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Retrieve the form data
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $phone = mysqli_real_escape_string($connection, $_POST['phone']);
    $address = mysqli_real_escape_string($connection, $_POST['address']);
    $location = mysqli_real_escape_string($connection, $_POST['location']);
    $guests = mysqli_real_escape_string($connection, $_POST['guests']);
    $arrivals = mysqli_real_escape_string($connection, $_POST['arrivals']);
    $leaving = mysqli_real_escape_string($connection, $_POST['leaving']);

    // Create the SQL query
    $request = "INSERT INTO book_form (name, email, phone, address, location, guests, arrivals, leaving) 
                VALUES ('$name', '$email', '$phone', '$address', '$location', '$guests', '$arrivals', '$leaving')";

    // Execute the query
    if (mysqli_query($connection, $request)) {
        // Data insertion successful, redirect to the book.php page
        header('Location: book.php');
        exit(); // Stop further execution of the script
    } else {
        // If an error occurs during data insertion, display an error message
        echo "Error: " . mysqli_error($connection);
    }

    // Close the database connection
    mysqli_close($connection);
} else {
    // If the form is not submitted, display an error message
    echo "Error: Form not submitted.";
}
?>
