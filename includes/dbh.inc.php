<?php
$hostname = "localhost";
$usernames = "root";
$password = ""; 
$database = "tuhr_database";


$mysqli = new mysqli($hostname, $usernames, $password, $database);


if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}


