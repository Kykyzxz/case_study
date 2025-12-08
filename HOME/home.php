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
                <a href="home.html">HOME</a>
                <a href="../ARTLIST/artworks.php">ARTWORK LIST</a>
                <a href="../ABOUT/about.html">ABOUT</a>
            </div>
        </nav>
        <nav class="tablet-mobile">
            <div class="title">NOCTURNE GALLERY</div>
            <button id="menubtn" onclick="toggle(true)"><img src="ICONS/menu-1-svgrepo-com.svg" alt="Menu"></button>
            <button id="closebtn" class="hidden" onclick="toggle(false)"><img src="ICONS/close-1511-svgrepo-com.svg" alt="Close"></button>
        </nav>
        <div id="panel" class="panel hidden">
            <a href="home.html">HOME</a>
            <hr style="width: 95%;">
            <a href="../ARTLIST/artworks.php">ARTWORK LIST</a>
            <hr style="width: 95%;">
            <a href="../ABOUT/about.html">ABOUT</a>
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
        <script>
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