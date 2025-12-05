<?php
    session_start();
    include "../connection/connect.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Get data from form
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        // Check if email exists in database
        $sql = "SELECT * FROM user_acc WHERE email='$email'";
        $result = $conn->query($sql);

        if($result->num_rows > 0){
            // Fetch user data
            $row = $result->fetch_assoc();
            
            // Verify password
            if(password_verify($password, $row['password'])){
                // Password is correct, create session
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['fullname'] = $row['fullname'];
                $_SESSION['email'] = $row['email'];
                
                echo "Login successful! Welcome " . $row['fullname'];
                
                // Redirect to dashboard or home page
                // header("Location: ../dashboard.php");
                // exit();
            }
            else{
                echo "Invalid password!";
            }
        }
        else{
            echo "No account found with this email!";
        }
    }

    $conn->close();
?>