<?php
session_start();
require_once '../backend/connection/connect.php';

// Turn on dev debug only while troubleshooting
$DEBUG = true; // set to false after debugging

// Helper to debug (writes to PHP error log or session)
function dev_log($msg) {
    global $DEBUG;
    if ($DEBUG) {
        error_log("[DEV] " . $msg);
        // also optionally store in session for display on login page:
        $_SESSION['dev_log'] = ($_SESSION['dev_log'] ?? "") . nl2br(htmlspecialchars($msg)) . "<br>";
    }
}

// --------------------- REGISTER ---------------------
if (isset($_POST['register'])) {
    $fullname = trim($_POST['fullname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $c_password = $_POST['c_password'] ?? '';

    if ($password !== $c_password) {
        $_SESSION['register_error'] = 'Passwords do not match!';
        header("Location: register.php");
        exit();
    }

    // Ensure password column can store hash (administrative check)
    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepared statement to check email
    $stmt = $conn->prepare("SELECT user_id FROM user_acc WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $_SESSION['register_error'] = 'Email is already registered!';
        $stmt->close();
        header("Location: register.php");
        exit();
    }
    $stmt->close();

    // Insert new user with prepared statement
    $insert = $conn->prepare("INSERT INTO user_acc (fullname, email, password) VALUES (?, ?, ?)");
    $insert->bind_param("sss", $fullname, $email, $hashed_password);
    if (!$insert->execute()) {
        // debug DB error
        dev_log("Insert failed: (" . $insert->errno . ") " . $insert->error);
        $_SESSION['register_error'] = "Registration failed (DB error).";
        $insert->close();
        header("Location: register.php");
        exit();
    }
    $insert->close();

    $_SESSION['register_success'] = "Registration successful. You can now login.";
    header("Location: login.php");
    exit();
}


// --------------------- LOGIN ---------------------
// --------------------- LOGIN ---------------------
if (isset($_POST['login'])) {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // Admin login
    if ($email === "admin@gmail.com" && $password === "admin123") {
        header("Location: ../ADMIN/admin.php");
        exit();
    }

    // Fetch user row
    $stmt = $conn->prepare("SELECT user_id, fullname, email, password FROM user_acc WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $_SESSION['login_error'] = "Email not found!";
        $stmt->close();
        header("Location: login.php");
        exit();
    }

    $user = $result->fetch_assoc();
    $stored_hash = $user['password'];

    // Debugging (optional)
    dev_log("Stored hash: " . substr($stored_hash, 0, 30));

    // Verify password
    if (!password_verify($password, $stored_hash)) {
        $_SESSION['login_error'] = "Incorrect password!";
        $stmt->close();
        header("Location: login.php");
        exit();
    }

    // Successful login
    $_SESSION['user_id'] = $user['user_id']; 
    $_SESSION['fullname'] = $user['fullname'];
    $_SESSION['email'] = $user['email'];

    $stmt->close();
    header("Location: ../HOME/home.php");
    exit();
}

?>
