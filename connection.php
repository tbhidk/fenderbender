<?php

$servername = "localhost";

$dbname = "testfender";
// REPLACE with Database user
$username = "root";
// REPLACE with Database user password
$password = "";

// Keep this API Key value to be compatible with the ESP32 code provided in the project page.
// If you change this value, the ESP32 sketch needs to match
$api_key_value = "TKuwrbo20wOYX";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    mysqli_select_db($conn, 'testfender');  
}

?>