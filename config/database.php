<?php

session_start();

function test_input($data) {
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// $host = "localhost";
// $dbname = "movie_app";
// $username = "root";
// $password = "";

$host = "sql12.freesqldatabase.com";
$dbname = "sql12770204";
$username = "sql12770204";
$password = "iLSylBTzE4";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
