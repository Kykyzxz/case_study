// Global state
let currentPage = 1;
let currentFilters = {
    category: '',
    artist: '',
    sort: 'latest'
};

// for logout
function openPopup() {
    document.querySelector(".popup-overlay").style.display = "flex";
}
function closePopup() {
    document.querySelector(".popup-overlay").style.display = "none";
}

// Toggle mobile menu
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

// Switch view for main artwork section
function switchView(view) {
    const container = document.querySelector('.artwork-container');
    const gridBtn = document.querySelector('.grid-view');
    const listBtn = document.querySelector('.list-view');

    if (view === 'grid') {
        container.classList.remove('list-layout');
        container.classList.add('grid-layout');
        gridBtn.classList.add('active');
        listBtn.classList.remove('active');
    } else {
        container.classList.remove('grid-layout');
        container.classList.add('list-layout');
        listBtn.classList.add('active');
        gridBtn.classList.remove('active');
    }
}

// Switch view for local artists section
function switchLocalView(view) {
    const container = document.querySelector('.local-artists-container');
    const gridBtn = document.querySelector('.local-grid-view');
    const listBtn = document.querySelector('.local-list-view');

    if (view === 'grid') {
        container.classList.remove('list-layout');
        container.classList.add('grid-layout');
        gridBtn.classList.add('active');
        listBtn.classList.remove('active');
    } else {
        container.classList.remove('grid-layout');
        container.classList.add('list-layout');
        listBtn.classList.add('active');
        gridBtn.classList.remove('active');
    }
}


async function toggleLike(artworkId, heartIcon, likeCount) {

    const isCurrentlyLiked = heartIcon.classList.contains('fas');
    const currentCount = parseInt(likeCount.textContent);
    
    if (isCurrentlyLiked) {
        heartIcon.classList.remove('fas');
        heartIcon.classList.add('far');
        heartIcon.style.color = '#93c5fd';
        likeCount.textContent = currentCount - 1;
    } else {
        heartIcon.classList.remove('far');
        heartIcon.classList.add('fas');
        heartIcon.style.color = '#ef4444';
        likeCount.textContent = currentCount + 1;
    }

    const likeBtn = heartIcon.closest('.like-btn');
    likeBtn.style.pointerEvents = 'none';
    
    try {
        const response = await fetch('../backend/artworks/toggle_like.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ artwork_id: artworkId })
        });

        const data = await response.json();

        if (data.success) {
            // Sync with actual server count (in case of discrepancy)
            likeCount.textContent = data.like_count;
        } else {
            if (isCurrentlyLiked) {
                heartIcon.classList.remove('far');
                heartIcon.classList.add('fas');
                heartIcon.style.color = '#ef4444';
                likeCount.textContent = currentCount;
            } else {
                heartIcon.classList.remove('fas');
                heartIcon.classList.add('far');
                heartIcon.style.color = '#93c5fd';
                likeCount.textContent = currentCount;
            }
            
            if (data.message.includes('login')) {
                alert('Please login to like artworks');
                window.location.href = '../AUTHENTICATION/login.php';
            } else {
                alert(data.message);
            }
        }
    } catch (error) {
        console.error('Error toggling like:', error);
        
        if (isCurrentlyLiked) {
            heartIcon.classList.remove('far');
            heartIcon.classList.add('fas');
            heartIcon.style.color = '#ef4444';
            likeCount.textContent = currentCount;
        } else {
            heartIcon.classList.remove('fas');
            heartIcon.classList.add('far');
            heartIcon.style.color = '#93c5fd';
            likeCount.textContent = currentCount;
        }
        
        alert('Failed to update like. Please try again.');
    } finally {
        // Re-enable button
        likeBtn.style.pointerEvents = 'auto';
    }
}

// Log artwork view
function logArtworkView(artworkId) {
    fetch('../backend/artworks/log_artwork_view.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ artwork_id: artworkId })
    })
    .then(response => response.json())
    .then(data => {
        console.log('👁️ View logged:', data);
    })
    .catch(error => {
        console.error('❌ Error logging view:', error);
    });
}

// Load main artworks
function loadArtworks(page = 1) {
    console.log('🔄 Loading artworks... Page:', page);
    console.log('📋 Current filters:', currentFilters);
    
    const container = document.querySelector('.artwork-container');
    container.innerHTML = '<p style="color: #93c5fd; text-align: center; padding: 40px; grid-column: 1/-1;">⏳ Loading artworks...</p>';
    
    const params = new URLSearchParams({
        category: currentFilters.category,
        artist: currentFilters.artist,
        sort: currentFilters.sort,
        page: page
    });

    const url = `../backend/artworks/fetch_artworks.php?${params}`;
    console.log('🌐 Fetching from:', url);

    fetch(url)
        .then(response => {
            console.log('✅ Response status:', response.status);
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.text();
        })
        .then(text => {
            console.log('📦 Raw response:', text.substring(0, 200) + '...');
            try {
                const data = JSON.parse(text);
                console.log('✨ Parsed data:', data);
                
                if (data.success) {
                    console.log('🎉 Success! Found', data.total, 'artworks');
                    displayArtworks(data.artworks);
                    updateArtworkCount(data.total);
                    updatePagination(data.page, data.totalPages);
                    currentPage = data.page;
                } else {
                    console.error('❌ Failed to load artworks:', data.message);
                    displayNoArtworks(data.message || 'No artworks found matching your criteria.');
                }
            } catch (e) {
                console.error('❌ JSON Parse error:', e);
                console.error('📄 Response was:', text);
                displayNoArtworks('Failed to parse server response. Check console for details.');
            }
        })
        .catch(error => {
            console.error('❌ Fetch error:', error);
            displayNoArtworks('Unable to connect to server. Please check your connection.');
        });
}

function displayArtworks(artworks) {
    const container = document.querySelector('.artwork-container');
    
    if (!artworks || artworks.length === 0) {
        container.innerHTML = '<p style="color: #93c5fd; text-align: center; padding: 40px; grid-column: 1/-1;">😔 No artworks found matching your criteria.</p>';
        return;
    }

    container.innerHTML = '';

    artworks.forEach(artwork => {
        const artworkWrapper = document.createElement('div');
        artworkWrapper.className = 'artwork-item';

        const maxDescLength = 150;
        let description = artwork.description;
        if (description.length > maxDescLength) {
            description = description.substring(0, maxDescLength) + '...';
        }

        // Heart icon class based on user_liked
        const heartClass = artwork.user_liked ? 'fas' : 'far';
        const heartColor = artwork.user_liked ? '#ef4444' : '#93c5fd';

        artworkWrapper.innerHTML = `
            <a href="#" class="artwork-link" data-artwork-id="${artwork.id}">
                <div class="artwork-image-wrapper">
                    <img src="${artwork.image}" alt="${artwork.title}" onerror="this.src='../HOME/ICONS/placeholder.jpg'">
                </div>
                <div class="content-container">
                    <div class="category-container">
                        <h3>${artwork.category}</h3>
                    </div>
                    <div class="artwork-content">
                        <h2 class="artwork-title">${artwork.title}</h2>
                        <h3 class="artwork-author"><i>${artwork.artist}</i></h3>
                        <h5 class="artwork-year">${artwork.year}</h5>
                        <p class="artwork-description">${description}</p>
                    </div>
                </div>
            </a>
            <div class="artwork-stats">
                <button class="like-btn" data-artwork-id="${artwork.id}">
                    <i class="${heartClass} fa-heart" style="color: ${heartColor};"></i>
                    <span class="like-count">${artwork.like_count}</span>
                </button>
                <button class="comment-btn" data-artwork-id="${artwork.id}">
                    <i class="far fa-comment" style="color: #93c5fd;"></i>
                    <span class="comment-count">${artwork.comment_count}</span>
                </button>
            </div>
        `;

        container.appendChild(artworkWrapper);

        // Add click event listener to artwork link
        const artworkLink = artworkWrapper.querySelector('.artwork-link');
        artworkLink.addEventListener('click', (e) => {
            e.preventDefault();
            const artworkId = artworkLink.getAttribute('data-artwork-id');
            
            // Log the view
            logArtworkView(artworkId);
            
            // Navigate to detail page after a short delay
            setTimeout(() => {
                window.location.href = `ARTFILE/artwork_detail.php?id=${artworkId}`;
            }, 100);
        });

        // Add like button event listener
        const likeBtn = artworkWrapper.querySelector('.like-btn');
        likeBtn.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            const heartIcon = likeBtn.querySelector('.fa-heart');
            const likeCount = likeBtn.querySelector('.like-count');
            toggleLike(artwork.id, heartIcon, likeCount);
        });

        // Add comment button event listener
        const commentBtn = artworkWrapper.querySelector('.comment-btn');
        commentBtn.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            const artworkId = commentBtn.getAttribute('data-artwork-id');
            
            // Log the view
            logArtworkView(artworkId);
            
            // Navigate to detail page with hash to scroll to comments
            window.location.href = `ARTFILE/artwork_detail.php?id=${artworkId}#comments`;
        });
    });

    setTimeout(adjustCardHeights, 100);
}

// Display no artworks message
function displayNoArtworks(message = 'Unable to load artworks. Please try again later.') {
    const container = document.querySelector('.artwork-container');
    container.innerHTML = `<p style="color: #93c5fd; text-align: center; padding: 40px; grid-column: 1/-1;">${message}</p>`;
    updateArtworkCount(0);
    
    const pageContainer = document.querySelector('.page-btn');
    if (pageContainer) {
        pageContainer.innerHTML = '';
    }
}

// Update artwork count
function updateArtworkCount(total) {
    const countElement = document.querySelector('.count');
    if (countElement) {
        countElement.textContent = total;
        console.log('📊 Updated count to:', total);
    }
}

// Update pagination buttons
function updatePagination(currentPage, totalPages) {
    const pageContainer = document.querySelector('.page-btn');
    if (!pageContainer) {
        console.warn('⚠️ Pagination container not found');
        return;
    }
    
    console.log('📄 Updating pagination - Page', currentPage, 'of', totalPages);
    
    pageContainer.innerHTML = '';

    if (totalPages <= 1) {
        console.log('ℹ️ Only 1 page, hiding pagination');
        return;
    }

    const prevBtn = document.createElement('button');
    prevBtn.className = 'prev-btn';
    prevBtn.textContent = 'Previous';
    prevBtn.disabled = currentPage === 1;
    prevBtn.onclick = () => {
        if (currentPage > 1) {
            window.scrollTo({ top: 0, behavior: 'smooth' });
            loadArtworks(currentPage - 1);
        }
    };
    pageContainer.appendChild(prevBtn);

    const startPage = Math.max(1, currentPage - 2);
    const endPage = Math.min(totalPages, startPage + 4);

    for (let i = startPage; i <= endPage; i++) {
        const pageBtn = document.createElement('button');
        pageBtn.className = 'page-num';
        if (i === currentPage) pageBtn.classList.add('active');
        pageBtn.textContent = i;
        pageBtn.onclick = () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
            loadArtworks(i);
        };
        pageContainer.appendChild(pageBtn);
    }

    const nextBtn = document.createElement('button');
    nextBtn.className = 'next-btn';
    nextBtn.textContent = 'Next';
    nextBtn.disabled = currentPage === totalPages;
    nextBtn.onclick = () => {
        if (currentPage < totalPages) {
            window.scrollTo({ top: 0, behavior: 'smooth' });
            loadArtworks(currentPage + 1);
        }
    };
    pageContainer.appendChild(nextBtn);
    
    console.log('✅ Pagination updated successfully');
}

// Load local artworks
function loadLocalArtworks() {
    console.log('🔄 Loading local artworks with filters...');
    console.log('📋 Current filters:', currentFilters);
    
    const container = document.querySelector('.local-artists-container');
    container.innerHTML = '<p style="color: #93c5fd; text-align: center; padding: 40px; grid-column: 1/-1;">⏳ Loading local artworks...</p>';
    
    const params = new URLSearchParams({
        category: currentFilters.category,
        artist: currentFilters.artist,
        sort: currentFilters.sort
    });

    const url = `../backend/artworks/fetch_local_artworks.php?${params}`;
    console.log('🌐 Fetching local artworks from:', url);
    
    fetch(url)
        .then(response => {
            console.log('✅ Local artworks response status:', response.status);
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.text();
        })
        .then(text => {
            console.log('📦 Local artworks raw response:', text.substring(0, 200) + '...');
            try {
                const data = JSON.parse(text);
                console.log('✨ Local artworks parsed data:', data);
                
                if (data.success) {
                    console.log('🎉 Success! Found', data.total, 'local artworks');
                    displayLocalArtworks(data.artworks);
                    updateLocalArtworkCount(data.total);
                } else {
                    console.error('❌ Failed to load local artworks:', data.message);
                    displayLocalArtworksError(data.message || 'No local artworks found matching your criteria.');
                }
            } catch (e) {
                console.error('❌ JSON Parse error:', e);
                console.error('📄 Response was:', text);
                displayLocalArtworksError('Failed to load local artworks. Check console for details.');
            }
        })
        .catch(error => {
            console.error('❌ Error loading local artworks:', error);
            displayLocalArtworksError('Unable to connect to server. Please check your connection.');
        });
}

// Display local artworks
function displayLocalArtworks(artworks) {
    const container = document.querySelector('.local-artists-container');
    
    if (!artworks || artworks.length === 0) {
        container.innerHTML = '<p style="color: #93c5fd; text-align: center; padding: 40px; grid-column: 1/-1;">😔 No local artworks available at the moment.</p>';
        return;
    }

    container.innerHTML = '';

    artworks.forEach(artwork => {
        const artworkItem = document.createElement('div');
        artworkItem.className = 'local-artist-item';

        const maxDescLength = 120;
        let description = artwork.description;
        if (description.length > maxDescLength) {
            description = description.substring(0, maxDescLength) + '...';
        }

        const heartClass = artwork.user_liked ? 'fas' : 'far';
        const heartColor = artwork.user_liked ? '#ef4444' : '#93c5fd';

        artworkItem.innerHTML = `
                <a href="#" class="local-artist-link" data-artwork-id="${artwork.id}">
                    <div class="local-artist-image-wrapper">
                        <img src="${artwork.image}" alt="${artwork.title}" onerror="this.src='../HOME/ICONS/placeholder.jpg'">
                    </div>
                    <div class="local-content-container">
                        <div class="local-category-container">${artwork.category}</div>
                        <h3 class="local-artwork-title">${artwork.title}</h3>
                        <p class="local-artist-name"><i>${artwork.artist}</i></p>
                        <p class="local-artwork-description">${description}</p>
                    </div>
                </a>
                <div class="artwork-stats">
                    <button class="like-btn" data-artwork-id="${artwork.id}">
                        <i class="${heartClass} fa-heart" style="color: ${heartColor};"></i>
                        <span class="like-count">${artwork.like_count}</span>
                    </button>
                    <button class="comment-btn" data-artwork-id="${artwork.id}">
                        <i class="far fa-comment" style="color: #93c5fd;"></i>
                        <span class="comment-count">${artwork.comment_count}</span>
                    </button>
                </div>
            `;

            container.appendChild(artworkItem);

            // Add click event listener to local artwork link
            const localArtworkLink = artworkItem.querySelector('.local-artist-link');
            localArtworkLink.addEventListener('click', (e) => {
                e.preventDefault();
                const artworkId = localArtworkLink.getAttribute('data-artwork-id');
                
                // Log the view
                logArtworkView(artworkId);
                
                // Navigate to detail page after a short delay
                setTimeout(() => {
                    window.location.href = `ARTFILE/artwork_detail.php?id=${artworkId}`;
                }, 100);
            });

        const likeBtn = artworkItem.querySelector('.like-btn');
        likeBtn.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            const heartIcon = likeBtn.querySelector('.fa-heart');
            const likeCount = likeBtn.querySelector('.like-count');
            toggleLike(artwork.id, heartIcon, likeCount);
        });

        // Add comment button event listener for local artworks
        const commentBtn = artworkItem.querySelector('.comment-btn');
        commentBtn.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            const artworkId = commentBtn.getAttribute('data-artwork-id');
            
            // Log the view
            logArtworkView(artworkId);
            
            // Navigate to detail page with hash to scroll to comments
            window.location.href = `ARTFILE/artwork_detail.php?id=${artworkId}#comments`;
        });
    });

    setTimeout(adjustCardHeights, 100);
}

// Display local artworks error
function displayLocalArtworksError(message) {
    const container = document.querySelector('.local-artists-container');
    container.innerHTML = `<p style="color: #93c5fd; text-align: center; padding: 40px; grid-column: 1/-1;">${message}</p>`;
    updateLocalArtworkCount(0);
}

// Update local artwork count
function updateLocalArtworkCount(total) {
    const countElement = document.querySelector('.local-artwork-total');
    if (countElement) {
        countElement.textContent = `${total} Local Artworks`;
        console.log('📊 Updated local artwork count to:', total);
    }
}

// Apply filters
function applyFilters() {
    console.log('🔍 Apply Filters button clicked!');
    
    const categorySelect = document.getElementById('category');
    const artistInput = document.getElementById('search-artist');
    const sortSelect = document.getElementById('sort-by');

    currentFilters.category = categorySelect ? categorySelect.value : '';
    currentFilters.artist = artistInput ? artistInput.value.trim() : '';
    currentFilters.sort = sortSelect ? sortSelect.value : 'latest';

    console.log('🎯 Applying filters to both sections:', currentFilters);
    
    const applyBtn = document.querySelector('.apply-filter');
    if (applyBtn) {
        applyBtn.textContent = 'Loading...';
        applyBtn.disabled = true;
    }
    

    loadArtworks(1);
    loadLocalArtworks();
    
    setTimeout(() => {
        if (applyBtn) {
            applyBtn.textContent = 'Apply Filters';
            applyBtn.disabled = false;
        }
    }, 1000);
}


// Reset filters
function resetFilters() {
    console.log('🔄 Reset Filters button clicked!');
    
    const categorySelect = document.getElementById('category');
    const artistInput = document.getElementById('search-artist');
    const sortSelect = document.getElementById('sort-by');

    if (categorySelect) categorySelect.value = '';
    if (artistInput) artistInput.value = '';
    if (sortSelect) sortSelect.value = 'latest';

    currentFilters = {
        category: '',
        artist: '',
        sort: 'latest'
    };

    console.log('✅ Filters reset to default for both sections');
    
    //Reset both national AND local artworks
    loadArtworks(1);
    loadLocalArtworks();
}

// Adjust card heights for masonry layout
function adjustCardHeights() {
    const cards = document.querySelectorAll('.artwork-item, .local-artist-item');
    cards.forEach(card => {
        const height = card.offsetHeight;
        const rowSpan = Math.ceil(height / 10);
        card.style.setProperty('--row-span', rowSpan);
    });
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 DOM Content Loaded - Initializing Nocturne Gallery...');
    
    loadArtworks();
    loadLocalArtworks();

    const applyBtn = document.querySelector('.apply-filter');
    const resetBtn = document.querySelector('.reset-filter');

    if (applyBtn) {
        applyBtn.addEventListener('click', applyFilters);
        console.log('✅ Apply filter button attached');
    } else {
        console.error('❌ Apply filter button not found!');
    }

    if (resetBtn) {
        resetBtn.addEventListener('click', resetFilters);
        console.log('✅ Reset filter button attached');
    } else {
        console.error('❌ Reset filter button not found!');
    }

    const artistInput = document.getElementById('search-artist');
    if (artistInput) {
        artistInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                console.log('⌨️ Enter key pressed in artist search');
                applyFilters();
            }
        });
        console.log('✅ Enter key listener attached to artist search');
    }

    const localGridBtn = document.querySelector('.local-grid-view');
    const localListBtn = document.querySelector('.local-list-view');

    if (localGridBtn) {
        localGridBtn.addEventListener('click', () => {
            console.log('🎨 Switching local view to grid');
            switchLocalView('grid');
        });
        console.log('✅ Local grid view button attached');
    }

    if (localListBtn) {
        localListBtn.addEventListener('click', () => {
            console.log('📋 Switching local view to list');
            switchLocalView('list');
        });
        console.log('✅ Local list view button attached');
    }

    const navbar = document.querySelector('nav.desktop');
    if (navbar) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
        console.log('✅ Navbar scroll effect attached');
    }
    
    window.addEventListener('resize', adjustCardHeights);
    console.log('✅ Window resize listener attached');
    
    console.log('✨ Initialization complete! Nocturne Gallery is ready.');
});