<?php
session_start(); // Start session to store login state
include "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Prepare the query to find the user by email
    $query = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $user["password"])) {
            // Store session variables
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["username"] = $user["username"];
            
            echo "✅ Login successful! Welcome, " . $user["username"] . "<br><a href='logout.php'>Logout</a>";
        } else {
            echo "❌ Incorrect password!";
        }
    } else {
        echo "❌ No user found with that email!";
    }
} else {
    echo "Invalid request!";
}
?>