<?php

$servername = "localhost";

$dbname = "id20277160_testfender001";
// REPLACE with Database user
$username = "id20277160_test";
// REPLACE with Database user password
$password = "H0wBoutTh!s!";

// Keep this API Key value to be compatible with the ESP32 code provided in the project page.
// If you change this value, the ESP32 sketch needs to match
$api_key_value = "TKuwrbo20wOYX";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    mysqli_select_db($conn, 'id20277160_testfender001');  
}

?>