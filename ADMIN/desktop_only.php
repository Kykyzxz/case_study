<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desktop Only - Admin Panel</title>
    <link rel="stylesheet" href="desktop_only.css">
    <script src="https://kit.fontawesome.com/2972950e8f.js" crossorigin="anonymous"></script>
</head>
<body>
    <script>
        // Prevent initial redirect loop
        sessionStorage.setItem('from_desktop_only', 'true');
        
        // Function to check screen size and redirect if needed
        function checkScreenSize() {
            const width = window.innerWidth;
            
            // Update the display
            const screenWidthElement = document.getElementById('screenWidth');
            if (screenWidthElement) {
                screenWidthElement.textContent = width;
            }
            
            // If screen is now desktop size (>= 1024px), redirect back to admin
            if (width >= 1024) {
                console.log('Desktop size detected - redirecting to admin.php');
                sessionStorage.setItem('from_desktop_only', 'true');
                window.location.href = 'admin.php';
            }
        }
        
        // Check immediately on load
        checkScreenSize();
        
        // Check on window resize with debounce to prevent too many checks
        let resizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                checkScreenSize();
            }, 250); // Wait 250ms after resize stops
        });
    </script>

    <div class="container">
        <div class="error-code">404</div>
        
        <div class="icon-container">
            <div style="position: relative; display: inline-block;">
                <i class="fa-solid fa-desktop desktop-icon"></i>
            </div>
            <div style="margin-top: 20px; position: relative; display: inline-block;">
                <i class="fa-solid fa-mobile-screen-button mobile-icon"></i>
                <span class="slash">/</span>
            </div>
        </div>
        
        <h1>Desktop Access Required</h1>
        <p class="subtitle">Admin Panel is Desktop Only</p>
        
        <p class="message">
            Sorry, the Admin Panel is optimized for desktop use only and requires a minimum screen width of 1024px. 
            Please access this page from a desktop or laptop computer for the best experience.
        </p>

        <div class="device-info">
            <i class="fa-solid fa-display"></i>
            <span>Current screen width: <strong id="screenWidth"></strong>px | Required: <strong>1024px</strong></span>
        </div>
    </div>

    <script>
        // Update screen width display on load
        function updateScreenWidth() {
            const width = window.innerWidth;
            document.getElementById('screenWidth').textContent = width;
        }
        
        updateScreenWidth();
    </script>
</body>
</html>