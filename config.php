<?php
    $host = "localhost";
    $port = 3306; // default port for MySQL
    $user = "root";
    $password = "";
    $dbname = "biologie";

    // Create a new database connection
    $conn = mysqli_connect($host, $user, $password, $dbname, $port);

    // Check if the connection was successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // If the connection was successful, do something here...

    // Close the database connection when done
?>
