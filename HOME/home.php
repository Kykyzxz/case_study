<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nocturne Gallery</title>
        <link rel="stylesheet" href="home.css">
        <link rel="icon" href="ICONS/favicon.ico" type="image/x-icon">
        <script src="home.js" defer></script>
    </head>
    <body>
        <nav class="desktop">
            <div class="title">NOCTURNE GALLERY</div>
            <div class="buttons">
                <a href="home.php">HOME</a>
                <a href="../ARTLIST/artworks.php">ARTWORK LIST</a>
                <a href="../ABOUT/about.php">ABOUT</a>
                <button class="logoutDesktop" onclick="openPopup()"><svg class="logoutIcon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M13 20C13 19.7348 13.1054 19.4804 13.2929 19.2929C13.4804 19.1054 13.7348 19 14 19H19V5H14C13.7348 5 13.4804 4.89464 13.2929 4.70711C13.1054 4.51957 13 4.26522 13 4C13 3.73478 13.1054 3.48043 13.2929 3.29289C13.4804 3.10536 13.7348 3 14 3H19C19.5304 3 20.0391 3.21071 20.4142 3.58579C20.7893 3.96086 21 4.46957 21 5V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21H14C13.7348 21 13.4804 20.8946 13.2929 20.7071C13.1054 20.5196 13 20.2652 13 20Z" fill-opacity="0.85"/>
                    <path d="M2.286 12.7001C2.10308 12.5142 2.00039 12.2639 2 12.0031V11.9971C2.00052 11.7329 2.1059 11.4797 2.293 11.2931L6.293 7.29308C6.38524 7.19757 6.49559 7.12139 6.61759 7.06898C6.7396 7.01657 6.87082 6.98898 7.0036 6.98783C7.13638 6.98668 7.26806 7.01198 7.39095 7.06226C7.51385 7.11254 7.6255 7.18679 7.71939 7.28069C7.81329 7.37458 7.88754 7.48623 7.93782 7.60913C7.9881 7.73202 8.0134 7.8637 8.01225 7.99648C8.0111 8.12926 7.98351 8.26048 7.9311 8.38249C7.87869 8.50449 7.80251 8.61483 7.707 8.70708L5.414 11.0001H15C15.2652 11.0001 15.5196 11.1054 15.7071 11.293C15.8946 11.4805 16 11.7349 16 12.0001C16 12.2653 15.8946 12.5197 15.7071 12.7072C15.5196 12.8947 15.2652 13.0001 15 13.0001H5.414L7.707 15.2931C7.88916 15.4817 7.98995 15.7343 7.98767 15.9965C7.9854 16.2587 7.88023 16.5095 7.69482 16.6949C7.50941 16.8803 7.2586 16.9855 6.9964 16.9878C6.7342 16.99 6.4816 16.8892 6.293 16.7071L2.293 12.7071L2.286 12.7001Z" fill-opacity="0.85"/>
                    </svg>Log out</button>
            </div>
        </nav>
        <nav class="tablet-mobile">
            <div class="title">NOCTURNE GALLERY</div>
            <button id="menubtn" onclick="toggle(true)"><img src="ICONS/menu-1-svgrepo-com.svg" alt="Menu"></button>
            <button id="closebtn" class="hidden" onclick="toggle(false)"><img src="ICONS/close-1511-svgrepo-com.svg" alt="Close"></button>
        </nav>
        <div id="panel" class="panel hidden">
            <a href="home.php">HOME</a>
            <hr style="width: 95%;">
            <a href="../ARTLIST/artworks.php">ARTWORK LIST</a>
            <hr style="width: 95%;">
            <a href="../ABOUT/about.php" style="margin-bottom: 20px;">ABOUT</a>
            <button class="logoutMobile" onclick="openPopup()"><svg class="logoutIcon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M13 20C13 19.7348 13.1054 19.4804 13.2929 19.2929C13.4804 19.1054 13.7348 19 14 19H19V5H14C13.7348 5 13.4804 4.89464 13.2929 4.70711C13.1054 4.51957 13 4.26522 13 4C13 3.73478 13.1054 3.48043 13.2929 3.29289C13.4804 3.10536 13.7348 3 14 3H19C19.5304 3 20.0391 3.21071 20.4142 3.58579C20.7893 3.96086 21 4.46957 21 5V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21H14C13.7348 21 13.4804 20.8946 13.2929 20.7071C13.1054 20.5196 13 20.2652 13 20Z" fill-opacity="0.85"/>
                <path d="M2.286 12.7001C2.10308 12.5142 2.00039 12.2639 2 12.0031V11.9971C2.00052 11.7329 2.1059 11.4797 2.293 11.2931L6.293 7.29308C6.38524 7.19757 6.49559 7.12139 6.61759 7.06898C6.7396 7.01657 6.87082 6.98898 7.0036 6.98783C7.13638 6.98668 7.26806 7.01198 7.39095 7.06226C7.51385 7.11254 7.6255 7.18679 7.71939 7.28069C7.81329 7.37458 7.88754 7.48623 7.93782 7.60913C7.9881 7.73202 8.0134 7.8637 8.01225 7.99648C8.0111 8.12926 7.98351 8.26048 7.9311 8.38249C7.87869 8.50449 7.80251 8.61483 7.707 8.70708L5.414 11.0001H15C15.2652 11.0001 15.5196 11.1054 15.7071 11.293C15.8946 11.4805 16 11.7349 16 12.0001C16 12.2653 15.8946 12.5197 15.7071 12.7072C15.5196 12.8947 15.2652 13.0001 15 13.0001H5.414L7.707 15.2931C7.88916 15.4817 7.98995 15.7343 7.98767 15.9965C7.9854 16.2587 7.88023 16.5095 7.69482 16.6949C7.50941 16.8803 7.2586 16.9855 6.9964 16.9878C6.7342 16.99 6.4816 16.8892 6.293 16.7071L2.293 12.7071L2.286 12.7001Z" fill-opacity="0.85"/>
            </svg>Log out</button>
        </div>
        <div class="slideshow">
            <div class="slides">
                <div class="slide"><img src="IMAGES/Van_Gogh_-_Starry_Night_-_Google_Art_Project.jpg" alt="Starry Night"></div>
                <div class="slide"><img src="IMAGES/The_Great_Wave_off_Kanagawa.jpg" alt="The Great Wave of Kanagawa"></div>
                <div class="slide"><img src="IMAGES/Anthropometry_of_the_Blue_Period.jpg" alt="Anthropometry of the Blue Period"></div>
            </div>
            <div class="slide-cont">
                <h1>Discover Extraordinary Art</h1>
                <p>Immerse yourself in a curated collection of contemporary masterpieces from visionary artists around the world and undiscovered local artists.</p>
                <button><a href="../ARTLIST/artworks.php">Explore Gallery</a></button>
            </div>
            <div class="dots">
                <span class="dot dot1"></span>
                <span class="dot dot2"></span>
                <span class="dot dot3"></span>
            </div>
        </div>
        <div class="art-cont">
            <div class="art-intro">
                <h1>What is <b>ART</b>?</h1>
                <p>Art is the intentional expression of human creativity and emotion, shaped into forms that communicate meaning beyond words. For artists, it’s a personal and cultural language — a way to reflect their inner experiences, challenge perspectives, and connect with others. Through their work, artists transform imagination into impact, making art not just a product, but a powerful process of exploration and storytelling.</p>
            </div>
            <img src="IMAGES/Starry Night and the Astronauts.jpg" alt="Starry Night and the Astronauts">
        </div>
        <div class="artworks-cont">
            <div class="featured">
                <h1>Featured Artworks</h1>
                <p>A curated glimpse into the minds of artists each piece a story waiting to be felt.</p>
            </div>
            <hr style="width: 95%; margin-top: -20px;">
            <div class="featured-images-cont">
                <div class="featured-images">
                    <img src="IMAGES/Van_Gogh_-_Starry_Night_-_Google_Art_Project.jpg" alt="Starry Night">
                    <div class="featured-info">
                        <h1>Starry Night  | 1889</h1>
                        <h3>Vincent Van Gogh | Post - Impressionism</h3>
                        <p>The Starry Night depicts a dreamy interpretation of the artist’s asylum room’s sweeping view of Saint-Rémy-de-Provence at night.</p>
                    </div>
                </div>
                <div class="featured-images">
                    <img src="IMAGES/the_scream_final_ms.jpg" alt="The Scream">
                    <div class="featured-info">
                        <h1>The Scream  | 1893</h1>
                        <h3>Edvard Munch | Proto-Expressionism</h3>
                        <p>The agonized face in the painting has become one of the most iconic images in art, seen as representing a profound experience of existential dread.</p>
                    </div>
                </div>
                <div class="featured-images">
                    <img src="IMAGES/K6H3LY574RH2VN7HN3N4BTERPI.avif" alt="Impression, Sunrise">
                    <div class="featured-info">
                        <h1>Impression, Sunrise  | 1872</h1>
                        <h3>Claude Monet | Impressionism</h3>
                        <p>Impression, Sunrise depicts the port of Le Havre, Monet's hometown. The painting is credited with inspiring the name of the Impressionist movement.</p>
                    </div>
                </div>
            </div>
            <button><a href="../ARTLIST/artworks.php">See more</a></button>
        </div>
        <div class="latest-feedback-cont">
            <div class="latest-feedback">
                <h1>Latest Feedback</h1>
                <p>Your voices inspire us to improve and create a better art experience.</p>
            </div>
            <div class="latest-feedback-texts">
                <!-- Feedback will be loaded dynamically here -->
                <div class="feedbacks">
                    <h3>Loading...</h3>
                    <p>"Please wait while we load the latest feedback."</p>
                </div>
            </div>
        </div>
        <div class="whistleblowers-cont">
            <div class="whistleblowers">
                <h1>Whistleblower Section</h1>
                <p>Help us improve by reporting any issues or concerns. Your feedback is confidential.</p>
            </div>
            <form id="feedbackForm" onsubmit="return false;">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="Enter your name" autocomplete="off" required><br><br>
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" placeholder="Enter your e-mail" autocomplete="off" required><br><br>
                <label for="feedback">Feedback</label>
                <textarea name="feedback" id="feedback" rows="10" cols="30" placeholder="Enter your feedback" required></textarea><br><br>
                <div class="submit">
                    <input type="submit" value="Submit Feedback">
                </div>
            </form>
        </div>
        <div class="contacts-cont">
            <div class="contacts">
                <div class="logo">
                    NOCTURNE <br>GALLERY
                    <div class="logos">
                        <img class="logo1" src="ICONS/facebook-svgrepo-com.svg" alt="Facebook">
                        <img class="logo2" src="ICONS/email-circle-fill-svgrepo-com.svg" alt="Email">
                        <img class="logo3" src="ICONS/github-142-svgrepo-com.svg" alt="Github">
                    </div>
                </div>
                <div class="contact">
                    <h4>Contacts</h4>
                    <p>nocturnegallery@gmail.com</p>
                    <p>(+63) 993-783-8753</p>
                </div>
            </div>
            <hr style="width: 95%; margin-top: 10px; color: #ffffff;">
            <div class="all-rights">© 2025 NOCTURNE GALLERY. All rights reserved. </div>
        </div>

        <div id="popup" class="popup-overlay">
            <div class="popup-box">
                <div class="icon-circle">
                    <svg class="logoutIcon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M13 20C13 19.7348 13.1054 19.4804 13.2929 19.2929C13.4804 19.1054 13.7348 19 14 19H19V5H14C13.7348 5 13.4804 4.89464 13.2929 4.70711C13.1054 4.51957 13 4.26522 13 4C13 3.73478 13.1054 3.48043 13.2929 3.29289C13.4804 3.10536 13.7348 3 14 3H19C19.5304 3 20.0391 3.21071 20.4142 3.58579C20.7893 3.96086 21 4.46957 21 5V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21H14C13.7348 21 13.4804 20.8946 13.2929 20.7071C13.1054 20.5196 13 20.2652 13 20Z" fill-opacity="0.85"/>
                    <path d="M2.286 12.7001C2.10308 12.5142 2.00039 12.2639 2 12.0031V11.9971C2.00052 11.7329 2.1059 11.4797 2.293 11.2931L6.293 7.29308C6.38524 7.19757 6.49559 7.12139 6.61759 7.06898C6.7396 7.01657 6.87082 6.98898 7.0036 6.98783C7.13638 6.98668 7.26806 7.01198 7.39095 7.06226C7.51385 7.11254 7.6255 7.18679 7.71939 7.28069C7.81329 7.37458 7.88754 7.48623 7.93782 7.60913C7.9881 7.73202 8.0134 7.8637 8.01225 7.99648C8.0111 8.12926 7.98351 8.26048 7.9311 8.38249C7.87869 8.50449 7.80251 8.61483 7.707 8.70708L5.414 11.0001H15C15.2652 11.0001 15.5196 11.1054 15.7071 11.293C15.8946 11.4805 16 11.7349 16 12.0001C16 12.2653 15.8946 12.5197 15.7071 12.7072C15.5196 12.8947 15.2652 13.0001 15 13.0001H5.414L7.707 15.2931C7.88916 15.4817 7.98995 15.7343 7.98767 15.9965C7.9854 16.2587 7.88023 16.5095 7.69482 16.6949C7.50941 16.8803 7.2586 16.9855 6.9964 16.9878C6.7342 16.99 6.4816 16.8892 6.293 16.7071L2.293 12.7071L2.286 12.7001Z" fill-opacity="0.85"/>
                    </svg>
                </div>
                <h2>Log out</h2>
                <p>Are you sure you want to logout?</p>
                <div class="popup-actions">
                    <button class="btn-cancel" onclick="closePopup()">Cancel</button>
                    <button class="btn-logout" onclick="window.location.href='../backend/logout/logout.php'">Log out</button>
                </div>
            </div>
        </div>
        <script>
            // for logout
            function openPopup() {
                document.querySelector(".popup-overlay").style.display = "flex";
            }
            function closePopup() {
                document.querySelector(".popup-overlay").style.display = "none";
            }
            function toggle(show) {
                const menu = document.getElementById('menubtn');
                const close = document.getElementById('closebtn');
                const panel = document.getElementById('panel');

                if (show) {
                    menu.classList.add('hidden');
                    close.classList.remove('hidden');
                    panel.classList.add('show');
                } else {
                    close.classList.add('hidden');
                    menu.classList.remove('hidden');
                    panel.classList.remove('show');
                }
            }
        </script>
    </body>
</html>