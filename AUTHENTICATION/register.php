<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Registration</title>
        <link rel="stylesheet" href="register.css">
        <script src="https://kit.fontawesome.com/2972950e8f.js" crossorigin="anonymous"></script>
    </head>
    <body>
       
        <!-- main section -->
        <section class="main-section">
            <div class="main-container">
                <div class="logo-container">
                    <h1>logo</h1>
                </div>
                <div class="login-container">
                    <div class="form-title-container">
                        <h2>Sign up</h2>
                        <h4>Here, arts illuminate the night.</h4>
                    </div>
                    <?php
                    session_start();
                    if (isset($_SESSION['register_error'])) {
                        echo "<p style='color:red; text-align:center; font-weight:bold;'>
                                " . $_SESSION['register_error'] . "
                            </p>";
                        unset($_SESSION['register_error']);
                    }
                    ?>

                    <form action="login_register.php" method="POST" class="form-container">
                        <div class="input-wrapper">
                            <i class="fa-regular fa-user"></i>
                            <input type="text" name="fullname" placeholder="Fullname" required>
                        </div>
                         <div class="input-wrapper">
                            <i class="fa-regular fa-envelope"></i>
                            <input type="email" name="email" placeholder="Email" required>
                         </div>
                         <div class="input-wrapper">
                            <i class="fa-solid fa-lock"></i>
                            <input type="password" name="password" placeholder="Password" required>
                         </div>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-lock"></i>
                            <input type="password" name="c_password" placeholder="Confirm Password" required>
                         </div>
                        <div class="submit-container">
                            <input type="submit" value="Sign Up" name="register">
                        </div>
                    </form>
                    <div class="register-desc">
                        <span>----- Alreadyy a user? <a href="login.php">Login</a> here! -----</span>
                    </div>
                </div>
            </div>
        </section>


    </body>
</html>