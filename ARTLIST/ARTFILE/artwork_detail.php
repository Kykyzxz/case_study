<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/2972950e8f.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="artwork_detail.css">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <title>Nocturne Gallery - Artwork Details</title>
    </head>
    <body>
        <nav class="desktop">
            <div class="title">NOCTURNE GALLERY</div>
            <div class="buttons">
                <a href="../../HOME/home.php">HOME</a>
                <a href="../artworks.php">ARTWORK LIST</a>
                <a href="../../ABOUT/about.php">ABOUT</a>
                <button class="logoutDesktop" onclick="openPopup()"><svg class="logoutIcon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M13 20C13 19.7348 13.1054 19.4804 13.2929 19.2929C13.4804 19.1054 13.7348 19 14 19H19V5H14C13.7348 5 13.4804 4.89464 13.2929 4.70711C13.1054 4.51957 13 4.26522 13 4C13 3.73478 13.1054 3.48043 13.2929 3.29289C13.4804 3.10536 13.7348 3 14 3H19C19.5304 3 20.0391 3.21071 20.4142 3.58579C20.7893 3.96086 21 4.46957 21 5V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21H14C13.7348 21 13.4804 20.8946 13.2929 20.7071C13.1054 20.5196 13 20.2652 13 20Z" fill-opacity="0.85"/>
                    <path d="M2.286 12.7001C2.10308 12.5142 2.00039 12.2639 2 12.0031V11.9971C2.00052 11.7329 2.1059 11.4797 2.293 11.2931L6.293 7.29308C6.38524 7.19757 6.49559 7.12139 6.61759 7.06898C6.7396 7.01657 6.87082 6.98898 7.0036 6.98783C7.13638 6.98668 7.26806 7.01198 7.39095 7.06226C7.51385 7.11254 7.6255 7.18679 7.71939 7.28069C7.81329 7.37458 7.88754 7.48623 7.93782 7.60913C7.9881 7.73202 8.0134 7.8637 8.01225 7.99648C8.0111 8.12926 7.98351 8.26048 7.9311 8.38249C7.87869 8.50449 7.80251 8.61483 7.707 8.70708L5.414 11.0001H15C15.2652 11.0001 15.5196 11.1054 15.7071 11.293C15.8946 11.4805 16 11.7349 16 12.0001C16 12.2653 15.8946 12.5197 15.7071 12.7072C15.5196 12.8947 15.2652 13.0001 15 13.0001H5.414L7.707 15.2931C7.88916 15.4817 7.98995 15.7343 7.98767 15.9965C7.9854 16.2587 7.88023 16.5095 7.69482 16.6949C7.50941 16.8803 7.2586 16.9855 6.9964 16.9878C6.7342 16.99 6.4816 16.8892 6.293 16.7071L2.293 12.7071L2.286 12.7001Z" fill-opacity="0.85"/>
                </svg>Log out</button>
            </div>
        </nav>
        <nav class="tablet-mobile">
            <div class="title">NOCTURNE GALLERY</div>
            <button id="menubtn" onclick="toggle(true)"><img src="menu-1-svgrepo-com.svg" alt="Menu"></button>
            <button id="closebtn" class="hidden" onclick="toggle(false)"><img src="close-1511-svgrepo-com.svg" alt="Close"></button>
        </nav>
        <div id="panel" class="panel hidden">
            <a href="../../HOME/home.php">HOME</a>
            <hr style="width: 95%;">
            <a href="../artworks.php">ARTWORK LIST</a>
            <hr style="width: 95%;">
            <a href="../ABOUT/about.php" style="margin-bottom: 20px;">ABOUT</a>
            <button class="logoutMobile" onclick="openPopup()"><svg class="logoutIcon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M13 20C13 19.7348 13.1054 19.4804 13.2929 19.2929C13.4804 19.1054 13.7348 19 14 19H19V5H14C13.7348 5 13.4804 4.89464 13.2929 4.70711C13.1054 4.51957 13 4.26522 13 4C13 3.73478 13.1054 3.48043 13.2929 3.29289C13.4804 3.10536 13.7348 3 14 3H19C19.5304 3 20.0391 3.21071 20.4142 3.58579C20.7893 3.96086 21 4.46957 21 5V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21H14C13.7348 21 13.4804 20.8946 13.2929 20.7071C13.1054 20.5196 13 20.2652 13 20Z" fill-opacity="0.85"/>
                <path d="M2.286 12.7001C2.10308 12.5142 2.00039 12.2639 2 12.0031V11.9971C2.00052 11.7329 2.1059 11.4797 2.293 11.2931L6.293 7.29308C6.38524 7.19757 6.49559 7.12139 6.61759 7.06898C6.7396 7.01657 6.87082 6.98898 7.0036 6.98783C7.13638 6.98668 7.26806 7.01198 7.39095 7.06226C7.51385 7.11254 7.6255 7.18679 7.71939 7.28069C7.81329 7.37458 7.88754 7.48623 7.93782 7.60913C7.9881 7.73202 8.0134 7.8637 8.01225 7.99648C8.0111 8.12926 7.98351 8.26048 7.9311 8.38249C7.87869 8.50449 7.80251 8.61483 7.707 8.70708L5.414 11.0001H15C15.2652 11.0001 15.5196 11.1054 15.7071 11.293C15.8946 11.4805 16 11.7349 16 12.0001C16 12.2653 15.8946 12.5197 15.7071 12.7072C15.5196 12.8947 15.2652 13.0001 15 13.0001H5.414L7.707 15.2931C7.88916 15.4817 7.98995 15.7343 7.98767 15.9965C7.9854 16.2587 7.88023 16.5095 7.69482 16.6949C7.50941 16.8803 7.2586 16.9855 6.9964 16.9878C6.7342 16.99 6.4816 16.8892 6.293 16.7071L2.293 12.7071L2.286 12.7001Z" fill-opacity="0.85"/>
                </svg>Log out</button>
        </div>

        <!-- art detail section -->
        <section class="artwork-section">
            <div class="artwork-container">
                <div class="art-img-container">
                    <div class="back-btn-container">
                        <a href="../artworks.php" class="back-btn-link">
                            <button><i class="fa-solid fa-arrow-left-long fa-lg"></i>Back to Gallery</button>
                        </a>
                    </div>
                    <div class="art-detail-img">
                        <img id="artwork-image" src="" alt="">
                    </div>
                </div>
                <div class="art-details-container">
                    <div class="about-artwork">
                        <div class="artwork-details">
                            <div class="about-title">
                                <h1><i>About Artwork</i></h1>
                            </div>
                            <div class="artwork-title-info">
                                <h2 class="artwork-title" id="artwork-title">Loading...</h2>
                                <h3 class="artwork-author"><i id="artwork-artist"></i></h3>
                                <h4 class="artwork-year" id="artwork-year"></h4>
                            </div>
                            <div class="artwork-description">
                                <p class="artwork-desc" id="artwork-description"></p>
                            </div>
                        </div>
                    </div>
                    <!-- artwork specification -->
                    <div class="artwork-specification">
                        <div class="artwork-specification-title">
                            <h1><i>Artwork Specification</i></h1>
                        </div>
                        <div class="artwork-specification-details">
                            <div class="artwork-specs artist">
                                <h2>Artist</h2>
                                <p id="spec-artist"></p>
                            </div>
                            <div class="artwork-specs year-created">
                                <h2>Year created</h2>
                                <p id="spec-year"></p>
                            </div>
                            <div class="artwork-specs medium">
                                <h2>Medium</h2>
                                <p id="spec-medium"></p>
                            </div>
                            <div class="artwork-specs dimension">
                                <h2>Dimension</h2>
                                <p id="spec-dimension"></p>
                            </div>
                            <div class="artwork-specs category">
                                <h2>Category</h2>
                                <p id="spec-category"></p>
                            </div>
                            <div class="artwork-specs orientation">
                                <h2>Orientation</h2>
                                <p id="spec-orientation"></p>
                            </div>
                        </div>
                    </div>
                    <div class="about-artist">
                        <div class="about-artist-title">
                            <h1><i>About Artist</i></h1>
                        </div>
                        <div class="about-artist-name">
                            <h3 id="artist-name"></h3>
                        </div>
                        <div class="about-artist-description">
                            <p id="artist-description"></p>
                        </div>
                    </div>

                    <!-- Comments Section -->
                    <div class="comments-section" id="comments">
                        <h1 class="comments-header">Comments (<span id="comment-count">0</span>)</h1>
                        
                        <div id="comment-form-container">
                            <!-- Comment form will be inserted here -->
                        </div>

                        <div class="comments-list" id="comments-list">
                            <p class="no-comments">Loading comments...</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>
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
                    <button class="btn-logout" onclick="window.location.href='../../backend/logout/logout.php'">Log out</button>
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
            // Toggle function
            function toggle(show) {
                const panel = document.getElementById('panel');
                const menuBtn = document.getElementById('menubtn');
                const closeBtn = document.getElementById('closebtn');

                if (show) {
                    panel.classList.remove('hidden');
                    panel.classList.add('show');
                    menuBtn.classList.add('hidden');
                    closeBtn.classList.remove('hidden');
                } else {
                    panel.classList.remove('show');
                    setTimeout(() => {
                        panel.classList.add('hidden');
                    }, 400);
                    closeBtn.classList.add('hidden');
                    menuBtn.classList.remove('hidden');
                }
            }

            // Get artwork ID from URL
            const urlParams = new URLSearchParams(window.location.search);
            const artworkId = urlParams.get('id');

            console.log('Artwork ID:', artworkId);

            // Load artwork details
            if (artworkId) {
                const fetchUrl = `fetch_artwork_detail.php?id=${artworkId}`;
                console.log('Fetching from:', fetchUrl);

                fetch(fetchUrl)
                    .then(response => {
                        console.log('Response status:', response.status);
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.text();
                    })
                    .then(text => {
                        console.log('Raw response:', text);
                        try {
                            const data = JSON.parse(text);
                            console.log('Parsed data:', data);
                            scrollToCommentsIfNeeded();
                            if (data.success) {
                                const artwork = data.artwork;
                                
                                document.title = `${artwork.title} - Nocturne Gallery`;
                                
                                const imagePath = artwork.image;
                                document.getElementById('artwork-image').src = imagePath;
                                document.getElementById('artwork-image').alt = artwork.title;
                                document.getElementById('artwork-image').onerror = function() {
                                    this.src = '../../HOME/ICONS/placeholder.jpg';
                                };
                                
                                document.getElementById('artwork-title').textContent = artwork.title;
                                document.getElementById('artwork-artist').textContent = artwork.artist;
                                document.getElementById('artwork-year').textContent = artwork.year;
                                document.getElementById('artwork-description').textContent = artwork.description;
                                
                                document.getElementById('spec-artist').textContent = artwork.artist;
                                document.getElementById('spec-year').textContent = artwork.year;
                                document.getElementById('spec-medium').textContent = artwork.medium || 'N/A';
                                document.getElementById('spec-dimension').textContent = artwork.dimension || 'N/A';
                                document.getElementById('spec-category').textContent = artwork.category;
                                document.getElementById('spec-orientation').textContent = artwork.orientation || 'N/A';
                                
                                document.getElementById('artist-name').textContent = artwork.artist;
                                document.getElementById('artist-description').textContent = artwork.artist_desc || 'No artist description available.';
                                
                                // Load comments
                                loadComments();
                                checkLoginStatus();
                                
                            } else {
                                console.error('API returned error:', data.message);
                                alert('Artwork not found: ' + data.message);
                                window.location.href = '../artworks.php';
                            }
                        } catch (e) {
                            console.error('JSON Parse error:', e);
                            console.error('Response was not JSON:', text);
                            alert('Failed to parse artwork data');
                            window.location.href = '../artworks.php';
                        }
                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                        alert('Failed to load artwork details: ' + error.message);
                        window.location.href = '../artworks.php';
                    });
            } else {
                alert('No artwork ID provided');
                window.location.href = '../artworks.php';
            }
            function scrollToCommentsIfNeeded() {
                if (window.location.hash === '#comments') {
                    setTimeout(() => {
                        const commentsSection = document.getElementById('comments');
                        if (commentsSection) {
                            commentsSection.scrollIntoView({ 
                                behavior: 'smooth', 
                                block: 'start' 
                            });
                            console.log('✅ Scrolled to comments section');
                        }
                    }, 500);
                }
            }
            // Check if user is logged in
            function checkLoginStatus() {
                fetch('../../backend/artworks/get_artwork_stats.php?artwork_id=' + artworkId)
                    .then(response => response.json())
                    .then(data => {
                        const formContainer = document.getElementById('comment-form-container');
                        
                        if (data.logged_in) {
                            // Show comment form
                            formContainer.innerHTML = `
                                <form class="comment-form" id="comment-form">
                                    <textarea 
                                        id="comment-text" 
                                        class="comment-textarea" 
                                        placeholder="Share your thoughts about this artwork..." 
                                        maxlength="1000"
                                        required
                                    ></textarea>
                                    <button type="submit" class="comment-submit-btn">Post Comment</button>
                                </form>
                            `;
                            
                            // Add submit handler
                            document.getElementById('comment-form').addEventListener('submit', submitComment);
                        } else {
                            // Show login prompt
                            formContainer.innerHTML = `
                                <div class="login-prompt">
                                    <p>Please <a href="../../AUTHENTICATION/login.php">login</a> to leave a comment</p>
                                </div>
                            `;
                        }
                    })
                    .catch(error => console.error('Error checking login status:', error));
            }

            // Load comments
            function loadComments() {
                fetch(`../../backend/artworks/get_comments.php?artwork_id=${artworkId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            displayComments(data.comments);
                            document.getElementById('comment-count').textContent = data.total;
                        } else {
                            console.error('Failed to load comments:', data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error loading comments:', error);
                        document.getElementById('comments-list').innerHTML = '<p class="no-comments">Failed to load comments</p>';
                    });
            }

            // Display comments
            function displayComments(comments) {
                const commentsList = document.getElementById('comments-list');
                
                if (comments.length === 0) {
                    commentsList.innerHTML = '<p class="no-comments">No comments yet. Be the first to share your thoughts!</p>';
                    return;
                }

                commentsList.innerHTML = comments.map(comment => {
                    const date = new Date(comment.created_at);
                    const formattedDate = date.toLocaleDateString('en-US', { 
                        year: 'numeric', 
                        month: 'short', 
                        day: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    });

                    return `
                        <div class="comment-item">
                            <div class="comment-header">
                                <span class="comment-author">${comment.fullname}</span>
                                <span class="comment-date">${formattedDate}</span>
                            </div>
                            <p class="comment-text">${comment.comment_text}</p>
                        </div>
                    `;
                }).join('');
            }

            // Submit comment
            async function submitComment(e) {
                e.preventDefault();
                
                const textarea = document.getElementById('comment-text');
                const submitBtn = e.target.querySelector('.comment-submit-btn');
                const commentText = textarea.value.trim();

                if (!commentText) {
                    alert('Please enter a comment');
                    return;
                }

                submitBtn.disabled = true;
                submitBtn.textContent = 'Posting...';

                try {
                    const response = await fetch('../../backend/artworks/submit_comment.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            artwork_id: artworkId,
                            comment_text: commentText
                        })
                    });

                    const data = await response.json();

                    if (data.success) {
                        textarea.value = '';
                        loadComments(); // Reload all comments
                        alert('Comment posted successfully!');
                    } else {
                        if (data.message.includes('login')) {
                            alert('Please login to comment');
                            window.location.href = '../../AUTHENTICATION/login.php';
                        } else {
                            alert(data.message);
                        }
                    }
                } catch (error) {
                    console.error('Error submitting comment:', error);
                    alert('Failed to post comment. Please try again.');
                } finally {
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Post Comment';
                }
            }
        </script>
    </body>
</html>