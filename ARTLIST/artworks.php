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
                <a href="../ABOUT/about.html">ABOUT</a>
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
            <a href="../ABOUT/about.html">ABOUT</a>
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
    </body>
</html>