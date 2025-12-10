
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Login</title>
        <link rel="stylesheet" href="login.css">
        <script src="https://kit.fontawesome.com/2972950e8f.js" crossorigin="anonymous"></script>
    </head>
    <body>
       
        <!-- main section -->
        <section class="main-section">
            <div class="main-container">
                <div class="logo-container">
                    <img src="logo.png" alt="logo">
                </div>
                <div class="login-container">
                    <div class="form-title-container">
                        <h2>Login</h2>
                        <h4>Here, arts illuminate the night.</h4>
                    </div>
                    <?php
                    session_start();

                    if (isset($_SESSION['register_success'])) {
                        echo "<p style='color:green; text-align:center; font-weight:bold;'>
                                " . $_SESSION['register_success'] . "
                            </p>";
                        unset($_SESSION['register_success']);
                    }

                    if (isset($_SESSION['login_error'])) {
                        echo "<p style='color:red; text-align:center; font-weight:bold;'>
                                " . $_SESSION['login_error'] . "
                            </p>";
                        unset($_SESSION['login_error']);
                    }
                    ?>

                    <form action="login_register.php" method="post" class="form-container">
                         <div class="input-wrapper">
                            <i class="fa-regular fa-envelope"></i>
                            <input type="email" name="email" placeholder="Email" required>
                         </div>
                         <div class="input-wrapper">
                            <i class="fa-solid fa-lock"></i>
                            <input type="password" name="password" placeholder="Password" required="wow">
                         </div>
                        <div class="submit-container">
                            <input type="submit" value="Login" name="login">
                        </div>
                    </form>
                    <div class="register-desc">
                        <span>----- New here? <a href="register.php">Sign up</a> now -----</span>
                    </div>
                </div>
            </div>
        </section>



    </body>
</html>