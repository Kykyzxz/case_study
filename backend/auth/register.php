<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Include database connection
include "../connection/connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get data from form
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $c_password = trim($_POST['c_password']); // Make sure HTML uses c_password

    // Check if passwords match
    if ($password !== $c_password) {
        die("Passwords do not match!");
    }

    // Check if email already exists
    $stmt = $conn->prepare("SELECT id FROM user_acc WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        die("Email already has an account!");
    }
    $stmt->close();

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert new user using prepared statement
    $stmt = $conn->prepare("INSERT INTO user_acc (fullname, password, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $fullname, $hashed_password, $email);

    if ($stmt->execute()) {
        // Optionally create session
        $_SESSION['user_id'] = $stmt->insert_id;
        $_SESSION['fullname'] = $fullname;
        $_SESSION['email'] = $email;

        echo "Account created successfully!";
        // Redirect to login or dashboard
        // header("Location: ../../login.html");
        // exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
