<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="artworks.css">
        <link rel="icon" href="ICONS/favicon.ico" type="image/x-icon">
        <script src="https://kit.fontawesome.com/2972950e8f.js" crossorigin="anonymous"></script>
        <script src="artworks.js" defer></script>
        <title>Nocturne Gallery - Artwork Collection</title>
    </head>
    <body>
        <nav class="desktop">
            <div class="title">NOCTURNE GALLERY</div>
            <div class="buttons">
                <a href="../HOME/home.php">HOME</a>
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
        
        <!-- hero section -->
        <section class="hero">
            <div class="hero-content">
                <h1>Artwork Collection</h1>
                <p>
                    Explore our curated selection of exceptional artworks—from timeless classics to local contemporary masterpieces.
                </p>
            </div>
        </section>

        <!-- control list section -->
        <section class="controls">
            <div class="control-content">
                <!-- option control section -->
                <div class="control">
                    <label for="category">Category</label>
                    <select name="category" id="category">
                        <option value="">All Categories</option>
                        <option value="Impressionism">Impressionism</option>
                        <option value="Post-Impressionism">Post-Impressionism</option>
                        <option value="Proto-Expressionism">Proto-Expressionism</option>
                        <option value="Contemporary">Contemporary</option>
                        <option value="Renaissance">Renaissance</option>
                        <option value="Pop Art">Pop Art</option>
                        <option value="Tonalism">Tonalism</option>
                        <option value="Neo-Impressionism">Neo-Impressionism</option>
                        <option value="Abstract Art">Abstract Art</option>
                        <option value="Expressionism">Expressionism</option>
                    </select>
                </div>
                <div class="control">
                    <label for="search-artist">Artist</label>
                    <input type="text" id="search-artist" placeholder="Search by Artist name">
                </div>
                <div class="control">
                    <label for="sort-by">Sort by</label>
                    <select name="sort-by" id="sort-by">
                        <option value="latest">Latest</option>
                        <option value="oldest">Oldest</option>
                        <option value="a-z">A - Z</option>
                        <option value="z-a">Z - A</option>
                    </select>
                </div>
                <div class="control-btn">
                    <button class="apply-filter">Apply Filters</button>
                    <button class="reset-filter">Reset</button>
                </div>
            </div>
        </section>
        
        <!-- artwork count section / grid,list view option -->
         <section class="artwork-count-section">
            <div class="artwork-count">
                <h3>Showing <b class="count">0</b> Artworks</h3>
                <div class="artwork-layout-btn">
                    <button class="grid-view active" onclick="switchView('grid')">Grid View</button>
                    <button class="list-view" onclick="switchView('list')">List View</button>
                </div>
            </div>
         </section>

         <!-- artwork list -->
          <section class="artwork-section">
            <div class="artwork-container grid-layout">
                <!-- Artworks will be loaded dynamically here -->
                <p style="color: #93c5fd; text-align: center; padding: 40px; grid-column: 1/-1;">Loading artworks...</p>
            </div>
          </section>

          <!-- button controls for pages -->
           <section class="page-control">
                <div class="page-btn">
                    <!-- Pagination will be generated dynamically -->
                </div>
           </section>

        <!-- Local Artists Section -->
        <section class="local-artists-section">
            <div class="local-artists-header">
                <h2>Featured Local Artists</h2>
                <p>Discover exceptional works from talented artists in our community</p>
            </div>

            <!-- Local Artists Layout Control -->
            <div class="local-artwork-count">
                <h3 class="local-artwork-total">0 Local Artworks</h3>
                <div class="local-artwork-layout-btn">
                    <button class="local-grid-view active">Grid View</button>
                    <button class="local-list-view">List View</button>
                </div>
            </div>

            <div class="local-artists-container grid-layout">
                <!-- Local artworks will be loaded dynamically here -->
                <p style="color: #93c5fd; text-align: center; padding: 40px; grid-column: 1/-1;">Loading local artworks...</p>
            </div>
        </section>

        <!-- Footer -->
        <div class="contacts-cont">
            <div class="contacts">
                <div class="logo">
                    NOCTURNE <br>GALLERY
                    <div class="logos">
                        <img class="logo1" src="../HOME/ICONS/facebook-svgrepo-com.svg" alt="Facebook">
                        <img class="logo2" src="../HOME/ICONS/email-circle-fill-svgrepo-com.svg" alt="Email">
                        <img class="logo3" src="../HOME/ICONS/github-142-svgrepo-com.svg" alt="Github">
                    </div>
                </div>
                <div class="contact">
                    <h4>Contacts</h4>
                    <p>nocturnegallery@gmail.com</p>
                    <p>(+63) 993-783-8753</p>
                </div>
            </div>
            <hr style="width: 95%; margin-top: 10px; color: #ffffff;">
            <div class="all-rights">© 2025 NOCTURNE GALLERY. All rights reserved.</div>
        </div>

        <!-- logout overlay -->
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