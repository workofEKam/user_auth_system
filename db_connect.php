<?php 
$host = 'localhost';
$dbname = 'user_auth_system';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die('Connection Failed '. $conn->connect_error);
}
echo "Database connection successfull ";
?>