<?php
$serverName = "127.0.0.1";
$port = 3306;
$username = "root";
$password = "";
$dbname = "blog";

// Create connection
$conn = mysqli_connect($serverName, $username, $password, $dbname, $port);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}