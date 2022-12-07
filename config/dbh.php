<?php

$host = "localhost";
$user = "root";
$password = "";
$db = "rejuvenating_set";

$conn = mysqli_connect($host, $user, $password, $db);

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
