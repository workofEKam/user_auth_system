<?php
include "db_connect.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];


    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $query = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $query->bind_param("sss", $username, $email, $hashedPassword);

    if ($query->execute()) {
        echo "✅ Signup successful! <a href='login.php'>Login here</a>";
    } else {
        echo "❌ Error: " . $query->error;
    }
} else {
    echo "Invalid request!";
}
?>