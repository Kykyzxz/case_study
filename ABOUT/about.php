<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="about.css">
        <title>Nocturne Gallery</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="icon" href="ICONS/favicon.ico" type="image/x-icon">
        <script src="about.js" defer></script>
    </head>
    <body>
        <nav class="desktop">
            <div class="title">NOCTURNE GALLERY</div>
            <div class="buttons">
                <a href="../HOME/home.php">HOME</a>
                <a href="../ARTLIST/artworks.php">ARTWORK LIST</a>
                <a href="about.php">ABOUT</a>
                <button class="logoutDesktop" onclick="openPopup()"><svg class="logoutIcon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M13 20C13 19.7348 13.1054 19.4804 13.2929 19.2929C13.4804 19.1054 13.7348 19 14 19H19V5H14C13.7348 5 13.4804 4.89464 13.2929 4.70711C13.1054 4.51957 13 4.26522 13 4C13 3.73478 13.1054 3.48043 13.2929 3.29289C13.4804 3.10536 13.7348 3 14 3H19C19.5304 3 20.0391 3.21071 20.4142 3.58579C20.7893 3.96086 21 4.46957 21 5V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21H14C13.7348 21 13.4804 20.8946 13.2929 20.7071C13.1054 20.5196 13 20.2652 13 20Z" fill-opacity="0.85"/>
                    <path d="M2.286 12.7001C2.10308 12.5142 2.00039 12.2639 2 12.0031V11.9971C2.00052 11.7329 2.1059 11.4797 2.293 11.2931L6.293 7.29308C6.38524 7.19757 6.49559 7.12139 6.61759 7.06898C6.7396 7.01657 6.87082 6.98898 7.0036 6.98783C7.13638 6.98668 7.26806 7.01198 7.39095 7.06226C7.51385 7.11254 7.6255 7.18679 7.71939 7.28069C7.81329 7.37458 7.88754 7.48623 7.93782 7.60913C7.9881 7.73202 8.0134 7.8637 8.01225 7.99648C8.0111 8.12926 7.98351 8.26048 7.9311 8.38249C7.87869 8.50449 7.80251 8.61483 7.707 8.70708L5.414 11.0001H15C15.2652 11.0001 15.5196 11.1054 15.7071 11.293C15.8946 11.4805 16 11.7349 16 12.0001C16 12.2653 15.8946 12.5197 15.7071 12.7072C15.5196 12.8947 15.2652 13.0001 15 13.0001H5.414L7.707 15.2931C7.88916 15.4817 7.98995 15.7343 7.98767 15.9965C7.9854 16.2587 7.88023 16.5095 7.69482 16.6949C7.50941 16.8803 7.2586 16.9855 6.9964 16.9878C6.7342 16.99 6.4816 16.8892 6.293 16.7071L2.293 12.7071L2.286 12.7001Z" fill-opacity="0.85"/>
                    </svg>Log out</button>
            </div>
        </nav>
        <nav class="tablet-mobile">
            <div class="title">NOCTURNE GALLERY</div>
            <button id="menubtn" onclick="toggle(true)"><img src="../HOME/ICONS/menu-1-svgrepo-com.svg" alt="Menu"></button>
            <button id="closebtn" class="hidden" onclick="toggle(false)"><img src="../HOME/ICONS/close-1511-svgrepo-com.svg" alt="Close"></button>
        </nav>
        <div id="panel" class="panel hidden">
            <a href="../HOME/home.php">HOME</a>
            <hr style="width: 95%;">
            <a href="../ARTLIST/artworks.php">ARTWORK LIST</a>
            <hr style="width: 95%;">
           <a href="../ABOUT/about.php" style="margin-bottom: 20px;">ABOUT</a>
            <button class="logoutMobile" onclick="openPopup()"><svg class="logoutIcon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M13 20C13 19.7348 13.1054 19.4804 13.2929 19.2929C13.4804 19.1054 13.7348 19 14 19H19V5H14C13.7348 5 13.4804 4.89464 13.2929 4.70711C13.1054 4.51957 13 4.26522 13 4C13 3.73478 13.1054 3.48043 13.2929 3.29289C13.4804 3.10536 13.7348 3 14 3H19C19.5304 3 20.0391 3.21071 20.4142 3.58579C20.7893 3.96086 21 4.46957 21 5V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21H14C13.7348 21 13.4804 20.8946 13.2929 20.7071C13.1054 20.5196 13 20.2652 13 20Z" fill-opacity="0.85"/>
                <path d="M2.286 12.7001C2.10308 12.5142 2.00039 12.2639 2 12.0031V11.9971C2.00052 11.7329 2.1059 11.4797 2.293 11.2931L6.293 7.29308C6.38524 7.19757 6.49559 7.12139 6.61759 7.06898C6.7396 7.01657 6.87082 6.98898 7.0036 6.98783C7.13638 6.98668 7.26806 7.01198 7.39095 7.06226C7.51385 7.11254 7.6255 7.18679 7.71939 7.28069C7.81329 7.37458 7.88754 7.48623 7.93782 7.60913C7.9881 7.73202 8.0134 7.8637 8.01225 7.99648C8.0111 8.12926 7.98351 8.26048 7.9311 8.38249C7.87869 8.50449 7.80251 8.61483 7.707 8.70708L5.414 11.0001H15C15.2652 11.0001 15.5196 11.1054 15.7071 11.293C15.8946 11.4805 16 11.7349 16 12.0001C16 12.2653 15.8946 12.5197 15.7071 12.7072C15.5196 12.8947 15.2652 13.0001 15 13.0001H5.414L7.707 15.2931C7.88916 15.4817 7.98995 15.7343 7.98767 15.9965C7.9854 16.2587 7.88023 16.5095 7.69482 16.6949C7.50941 16.8803 7.2586 16.9855 6.9964 16.9878C6.7342 16.99 6.4816 16.8892 6.293 16.7071L2.293 12.7071L2.286 12.7001Z" fill-opacity="0.85"/>
            </svg>Log out</button>
        </div>
        <section class="hero">
            <div class="hero-content">
                <h1>About Nocturne Gallery</h1>
                <p>Where silence paints and shadows sing.
                    A gallery that is a sanctuary for art that whispers, glows and lingers. We curate pieces that evoke 
                    emotion through subtlety twilight tones, quiet gestures and dreamlike depth. Step into a space
                    where the night inspires and the soul listens.
                </p>
            </div>
        </section>
        <section class="about">
            <div class="about-img">
                <!-- Insert logo/img here -->
                <img src="about-us.jpg" alt="About Us Image">
            </div>
            <div class="about-content">
                <h2>Our Story</h2>
                <p>Nocturne Gallery was founded with the vision of creating a space where art speaks in silence and beauty emerges from stillness. Inspired by the mystery of the night, we curate pieces that capture emotion through light, shadow, and subtle expression. Our online gallery serves as a sanctuary for artists and admirers alike — a place where every work invites reflection, connection, and a quiet sense of wonder.</p>
                <p></p>
                <p>
                At Nocturne Gallery, we believe that art transcends boundaries of time and language. Each exhibition is thoughtfully curated to evoke introspection and serenity, allowing viewers to experience the intimate dialogue between darkness and illumination. Whether through digital showcases or collaborative projects, we aim to nurture a global community that celebrates the contemplative power of art and the timeless beauty found in moments of stillness.</p>
            </div>
        </section>
        <section class="mission-section">
            <div class="mission-container">
                <div class="mission">
                <h2>Our Mission</h2>
                <p>At Nocturne Gallery, our mission is to illuminate the profound beauty found in subtlety and silence. We are dedicated to showcasing art that evokes deep emotion through understated elegance, inviting viewers to explore the nuances of light and shadow. By fostering a community of artists and art lovers, we aim to create a sanctuary where creativity thrives and every piece tells a story that resonates beyond words.</p>
                </div>
                <div class="variables">
                    <div class="craft">
                        <i class="fa-solid fa-palette"></i>
                        <h3>Craft Emotion</h3>
                        <p>We seek not just beauty, but truth part that unsettles, reveals, and reimagines. Each work is chosen for its ability to stir the subconscious, to challenge the viewer’s gaze, and to echo the complexity of the human experience.</p>
                    </div>
                    <div class="Expand">
                        <i class="fa-solid fa-sun"></i>
                        <h3>Expand Horizon</h3>
                        <p>Art knows no borders. We cultivate a living network of creators and collectors who believe in the power of shared vision. Through this global exchange, we dissolve distance and build bridges of empathy, imagination, and insight.</p>
                    </div>
                    <div class="Empower">
                        <i class="fa-solid fa-lightbulb"></i>
                        <h3>Empower Artist</h3>
                        <p>To create is to risk, to reveal, to resist. We stand beside artists as they navigate the unknown offering space, support, and visibility to those who dare to shape the world through their craft. Their courage becomes our compass.</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="core-values">
            <h2>Our Core Values</h2>
            <div class="core-values-container">
                <div class="value-container">
                    
                    <h1><i class="fa-solid fa-stamp"></i>Authenticity</h1>
                    <p>We honor the raw, unfiltered voice of the artist. Every piece we present is a testament to truth uncompromised, unembellished, and deeply personal. In a world of replicas, we choose the original soul.</p>
                </div>
                <div class="value-container">
                    <h1><i class="fa-solid fa-shield"></i>Integrity</h1>
                    <p>Art is a sacred exchange. We uphold transparency in every transaction, dialogue, and decision ensuring that trust is not just earned, but continually reaffirmed.</p>
                </div>
                <div class="value-container">
                    <h1><i class="fa-solid fa-medal"></i>Excellence</h1>
                    <p>We curate with intention, not volume. Each work is selected for its resonance, its craftsmanship, and its ability to transcend the ordinary. Excellence, for us, is not perfection it’s presence.</p>
                </div>
                <div class="value-container">
                    <h1><i class="fa-solid fa-road"></i>Illumination</h1>
                    <p>We embrace innovation not for novelty, but for revelation. Through technology, experimentation, and bold thinking, we illuminate new paths for artists and audiences alike.</p>
                </div>
            </div>
        </section>
        <section class="team">
            <h2>Meet our Team</h2>
            <p>The passionate individuals behind Nocturne Gallery</p>

            <div class="member-list">
                <div class="member-container">
                <div class="member-img">
                    <img src="2X2/1.png" alt="Member 1">
                </div>
                <div class="member-desc">
                    <h3>Kyran Solomon</h3>
                    <p>Role: Designer/Developer </p>
                    <p>Responsible for creating the visual design and user interface while implementing front-end functionality. Bridges aesthetics and technical implementation to deliver a cohesive user experience.
                    </p>
                </div>
                </div>

                <div class="member-container">
                <div class="member-img">
                    <img src="2X2/2.png" alt="Member 2">
                </div>
                <div class="member-desc">
                    <h3>Luis Armann Barba</h3>
                    <p>Role: Designer/Developer</p>
                    <p>Responsible for creating the visual design and user interface while implementing front-end functionality. Bridges aesthetics and technical implementation to deliver a cohesive user experience.
                    </p>
                </div>
                </div>

                <div class="member-container">
                <div class="member-img">
                    <img src="2X2/3.png" alt="Member 3">
                </div>
                <div class="member-desc">
                    <h3>Jose Ishmael Lapus</h3>
                    <p>Role: Designer/Developer</p>
                    <p>Responsible for creating the visual design and user interface while implementing front-end functionality. Bridges aesthetics and technical implementation to deliver a cohesive user experience.
                    </p>
                </div>
                </div>

                <div class="member-container">
                <div class="member-img">
                    <img src="2X2/4.png" alt="Member 4">
                </div>
                <div class="member-desc">
                    <h3>Marc Cedrick Austria</h3>
                    <p>Role: Developer</p>
                    <p>Focuses on building and implementing the website's core functionality, including back-end logic, front-end features, and ensuring code quality and performance.
                    </p>
                </div>
                </div>

                <div class="member-container">
                <div class="member-img">
                    <img src="2X2/5.png" alt="Member 5">
                </div>
                <div class="member-desc">
                    <h3>Diane Alfero</h3>
                    <p>Role: Technical Writer</p>
                    <p>Maintains comprehensive documentation of the source code, including explaining the website's purpose, its functionalities, and the technical aspects involved in the development process, to ensure project clarity and maintainability.
                    </p>
                </div>
                </div>

                <div class="member-container">
                <div class="member-img">
                    <img src="2X2/6.png" alt="Member 6">
                </div>
                <div class="member-desc">
                    <h3>Vincent Charles</h3>
                    <p>Role: Technical Writer</p>
                    <p>Maintains comprehensive documentation of the source code, including explaining the website's purpose, its functionalities, and the technical aspects involved in the development process, to ensure project clarity and maintainability.
                    </p>
                </div>
                </div>

                <div class="member-container">
                <div class="member-img">
                    <img src="2X2/7.png" alt="Member 7">
                </div>
                <div class="member-desc">
                    <h3>Angel Manlutac</h3>
                    <p>Technical Writer</p>
                    <p>Maintains comprehensive documentation of the source code, including explaining the website's purpose, its functionalities, and the technical aspects involved in the development process, to ensure project clarity and maintainability.
                    </p>
                </div>
                </div>
            </div>
        </section>

        <!-- footer section -->
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
            <hr style="width: 100%; margin-top: 10px; color: #ffffff;">
        <div class="all-rights">© 2025 NOCTURNE GALLERY. All rights reserved. </div>

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
    </body>
</html>