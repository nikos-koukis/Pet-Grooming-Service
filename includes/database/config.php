<?php

require(__DIR__ . '../../../vendor/autoload.php');

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '../../../');
$dotenv->load();

$localhost = $_ENV["LOCALHOST"];
$username = $_ENV["NAME"];
$password = $_ENV["PASSWORD"];
$database = $_ENV["DATABASE"];

// Create connection
$db = new mysqli($localhost, $username, $password, $database);
mysqli_set_charset($db, "utf8");

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

?>