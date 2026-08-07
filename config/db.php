<?php

$host = "localhost";
$user = "root";
$password = ""; 
$dbname = "Go Egypt";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "connection failed : " . $conn->connect_error]));
}
?>