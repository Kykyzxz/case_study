// Buttons
const btnArtworks = document.getElementById("btn-artworks");
const btnArtworkLogs = document.getElementById("btn-artwork-logs");
const btnFeedback = document.getElementById("btn-feedback");

// Titles
const artworkTitle = document.getElementById("artwork-title");
const logsTitle = document.getElementById("logs-title");
const feedbackTitle = document.getElementById("feedback-title");

// Content sections
const artworkSection = document.getElementById("artwork-section");
const logsSection = document.getElementById("logs-section");
const feedbackSection = document.getElementById("feedback-section");

// Reset everything
function resetView() {
    artworkTitle.classList.remove("active");
    logsTitle.classList.remove("active");
    feedbackTitle.classList.remove("active");
    artworkSection.classList.remove("active");
    logsSection.classList.remove("active");
    feedbackSection.classList.remove("active");
    btnArtworks.classList.remove("active");
    btnArtworkLogs.classList.remove("active");
    btnFeedback.classList.remove("active");
}

// Show Artworks
btnArtworks.addEventListener("click", () => {
    resetView();
    btnArtworks.classList.add("active");
    artworkTitle.classList.add("active");
    artworkSection.classList.add("active");
});

// Show Artwork Logs
btnArtworkLogs.addEventListener("click", () => {
    resetView();
    btnArtworkLogs.classList.add("active");
    logsTitle.classList.add("active");
    logsSection.classList.add("active");
    
    // Load logs when section is opened
    loadArtworkLogs();
});

// Show Feedback
btnFeedback.addEventListener("click", () => {
    resetView();
    btnFeedback.classList.add("active");
    feedbackTitle.classList.add("active");
    feedbackSection.classList.add("active");
});

// Load Artwork Logs
function loadArtworkLogs() {
    logsSection.innerHTML = `
        <div class="logs-loading" style="grid-column: 1/-1; text-align: center; padding: 40px;">
            <i class="fa-solid fa-spinner fa-spin" style="font-size: 2rem; color: #667eea;"></i>
            <p style="margin-top: 15px; color: #666;">Loading activity logs...</p>
        </div>
    `;
    
    fetch('../backend/artworks/fetch_artwork_logs.php')
        .then(response => response.json())
        .then(data => {
            if (data.success && data.logs && data.logs.length > 0) {
                displayLogs(data.logs);
            } else {
                logsSection.innerHTML = `
                    <div style="grid-column: 1/-1; text-align: center; padding: 60px 20px; color: #666;">
                        <i class="fa-solid fa-clock-rotate-left" style="font-size: 4rem; margin-bottom: 20px; opacity: 0.2;"></i>
                        <h3 style="font-size: 1.3rem; margin-bottom: 10px;">No activity logs yet</h3>
                        <p style="font-size: 0.95rem;">User interactions with artworks will appear here.</p>
                    </div>
                `;
            }
        })
        .catch(error => {
            console.error('Error loading logs:', error);
            logsSection.innerHTML = `
                <div style="grid-column: 1/-1; text-align: center; padding: 60px 20px; color: #666;">
                    <i class="fa-solid fa-triangle-exclamation" style="font-size: 4rem; margin-bottom: 20px; opacity: 0.2; color: #ef4444;"></i>
                    <h3 style="font-size: 1.3rem; margin-bottom: 10px;">Error loading logs</h3>
                    <p style="font-size: 0.95rem;">Please try again later.</p>
                </div>
            `;
        });
}

// Display Logs
function displayLogs(logs) {
    const getActionIcon = (actionType) => {
        const icons = {
            'view': 'fa-eye',
            'like': 'fa-heart',
            'unlike': 'fa-heart-crack',
            'comment': 'fa-comment'
        };
        return icons[actionType] || 'fa-circle-info';
    };
    
    const getActionText = (log) => {
        const actions = {
            'view': `viewed the artwork`,
            'like': `liked the artwork`,
            'unlike': `unliked the artwork`,
            'comment': `commented on the artwork`
        };
        return actions[log.action_type] || 'performed an action on the artwork';
    };
    
    const formatTime = (timestamp) => {
        const date = new Date(timestamp);
        const now = new Date();
        const diff = Math.floor((now - date) / 1000); // difference in seconds
        
        if (diff < 60) return 'Just now';
        if (diff < 3600) return `${Math.floor(diff / 60)} min ago`;
        if (diff < 86400) return `${Math.floor(diff / 3600)} hours ago`;
        if (diff < 604800) return `${Math.floor(diff / 86400)} days ago`;
        
        return date.toLocaleDateString('en-US', { 
            month: 'short', 
            day: 'numeric',
            year: date.getFullYear() !== now.getFullYear() ? 'numeric' : undefined
        });
    };
    
    logsSection.innerHTML = logs.map(log => `
        <div class="log-item">
            <div class="log-icon ${log.action_type}">
                <i class="fa-solid ${getActionIcon(log.action_type)}"></i>
            </div>
            <div class="log-content">
                <div class="log-user">${escapeHtml(log.fullname)}</div>
                <div class="log-action">${getActionText(log)}</div>
                <span class="log-artwork-title">${escapeHtml(log.artwork_title)}</span>
            </div>
            <div class="log-meta">
                <div class="log-time">${formatTime(log.created_at)}</div>
                <div class="log-likes">
                    <i class="fa-solid fa-heart"></i>
                    <span>${log.total_likes}</span>
                </div>
            </div>
        </div>
    `).join('');
}

// Helper function to escape HTML
function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// Modal functions
function openModal() {
    document.getElementById('modalOverlay').classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('modalOverlay').classList.remove('active');
    document.body.style.overflow = 'auto';
    document.getElementById('artworkForm').reset();
    document.getElementById('fileName').textContent = 'No file chosen';
}

function updateFileName(input) {
    const fileName = input.files[0]?.name || 'No file chosen';
    document.getElementById('fileName').textContent = fileName;
}

// Submit form
function submitForm() {
    const form = document.getElementById('artworkForm');

    if (form.checkValidity()) {
        const formData = new FormData(form);

        const submitBtn = document.querySelector('.btn-submit');
        const originalHTML = submitBtn.innerHTML;
        
        submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Adding...';
        submitBtn.disabled = true;

        fetch('../backend/artworks/add_artwork.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(text => {
            console.log('Raw response:', text);

            try {
                const data = JSON.parse(text);

                if (data.success) {
                    alert('Artwork added successfully!');
                    closeModal();
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                    submitBtn.innerHTML = originalHTML;
                    submitBtn.disabled = false;
                }
            } catch (err) {
                console.error('JSON parse error:', err);
                alert('Server returned invalid response. Check console for details.');
                console.log('Response text:', text);
                submitBtn.innerHTML = originalHTML;
                submitBtn.disabled = false;
            }
        })
        .catch(error => {
            console.error('Fetch error:', error);
            alert('An error occurred while adding the artwork.');
            submitBtn.innerHTML = originalHTML;
            submitBtn.disabled = false;
        });

    } else {
        form.reportValidity();
    }
}

//viewartwork
function viewArtwork(id) {
    console.log('Viewing artwork ID:', id);
    
    // Show loading modal immediately
    showLoadingModal();
    
    fetch('../backend/artworks/view_artwork.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'artwork_id=' + id + '&from_admin=true'  // Add admin flag
    })
    .then(response => {
        if (!response.ok) throw new Error('Network response was not ok');
        return response.json();
    })
    .then(data => {
        closeLoadingModal();
        if (data.success) {
            showViewModal(data.data);
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        closeLoadingModal();
        console.error('Error:', error);
        alert('An error occurred while loading the artwork.');
    });
}

// Show loading modal for better UX
function showLoadingModal() {
    const loader = document.createElement('div');
    loader.className = 'loading-overlay';
    loader.id = 'loadingOverlay';
    loader.innerHTML = `
        <div class="loading-spinner">
            <i class="fa-solid fa-spinner fa-spin"></i>
            <p>Loading artwork...</p>
        </div>
    `;
    document.body.appendChild(loader);
    setTimeout(() => loader.classList.add('active'), 10);
}

// Close loading modal
function closeLoadingModal() {
    const loader = document.getElementById('loadingOverlay');
    if (loader) {
        loader.classList.remove('active');
        setTimeout(() => loader.remove(), 300);
    }
}

function showViewModal(artwork) {
    console.log('Artwork data received:', artwork);
    
    const modal = document.createElement('div');
    modal.className = 'view-modal-overlay';
    modal.id = 'viewModalOverlay';
    
    const escapeHtml = (text) => {
        if (!text) return 'N/A';
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    };
    
    modal.innerHTML = `
        <div class="view-modal-container">
            <div class="view-modal-header">
                <h2><i class="fa-solid fa-eye"></i> Artwork Details</h2>
                <button class="view-close-btn" onclick="closeViewModal()">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            
            <div class="view-modal-body">
                <div class="view-content-wrapper">
                    <div class="view-image-section">
                        <img src="uploads/artworks/${escapeHtml(artwork.image)}" 
                             alt="${escapeHtml(artwork.artwork_title)}"
                             loading="eager">
                    </div>
                    
                    <div class="view-details-section">
                        <div class="view-detail-group">
                            <label><i class="fa-solid fa-palette"></i> Artwork Title</label>
                            <p>${escapeHtml(artwork.artwork_title || 'N/A')}</p>
                        </div>
                        
                        <div class="view-detail-group">
                            <label><i class="fa-solid fa-user-pen"></i> Artist Name</label>
                            <p>${escapeHtml(artwork.artist || 'N/A')}</p>
                        </div>
                        
                        <div class="view-detail-row">
                            <div class="view-detail-group">
                                <label><i class="fa-solid fa-calendar"></i> Year Created</label>
                                <p>${escapeHtml(artwork.year_created || 'N/A')}</p>
                            </div>
                            
                            <div class="view-detail-group">
                                <label><i class="fa-solid fa-layer-group"></i> Medium</label>
                                <p>${escapeHtml(artwork.medium || 'N/A')}</p>
                            </div>
                        </div>
                        
                        <div class="view-detail-row">
                            <div class="view-detail-group">
                                <label><i class="fa-solid fa-ruler-combined"></i> Dimension</label>
                                <p>${escapeHtml(artwork.dimension || 'N/A')}</p>
                            </div>
                            
                            <div class="view-detail-group">
                                <label><i class="fa-solid fa-tag"></i> Category</label>
                                <p>${escapeHtml(artwork.category || 'N/A')}</p>
                            </div>
                        </div>
                        
                        <div class="view-detail-row">
                            <div class="view-detail-group">
                                <label><i class="fa-solid fa-arrows-rotate"></i> Orientation</label>
                                <p>${escapeHtml(artwork.orientation || 'N/A')}</p>
                            </div>
                            
                            <div class="view-detail-group">
                                <label><i class="fa-solid fa-circle-info"></i> Status</label>
                                <p><span class="status-badge status-${(artwork.status || '').toLowerCase()}">${escapeHtml(artwork.status || 'N/A')}</span></p>
                            </div>
                        </div>
                        
                        <div class="view-detail-group">
                            <label><i class="fa-solid fa-image"></i> Artwork Description</label>
                            <p class="description-text">${escapeHtml(artwork.artwork_desc || 'No description available')}</p>
                        </div>
                        
                        <div class="view-detail-group">
                            <label><i class="fa-solid fa-book"></i> Artist Description</label>
                            <p class="description-text">${escapeHtml(artwork.artist_desc || 'No artist description available')}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="view-modal-footer">
                <button class="btn btn-secondary" onclick="closeViewModal()">
                    <i class="fa-solid fa-xmark"></i> Close
                </button>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
    document.body.classList.add('modal-open');
    document.documentElement.classList.add('modal-open');
    document.body.style.overflow = 'hidden';
    document.documentElement.style.overflow = 'hidden';
    
    requestAnimationFrame(() => {
        modal.classList.add('active');
    });
    
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeViewModal();
        }
    });
}

// Close View Modal
function closeViewModal() {
    const modal = document.getElementById('viewModalOverlay');
    if (modal) {
        modal.classList.remove('active');
        setTimeout(() => {
            modal.remove();
            // Restore body scroll - Remove classes
            document.body.classList.remove('modal-open');
            document.documentElement.classList.remove('modal-open');
            document.body.style.overflow = '';
            document.documentElement.style.overflow = '';
        }, 300);
    }
}

// Edit Artwork
function editArtwork(id) {
    console.log('Editing artwork ID:', id);
    
    showLoadingModal();
    
    fetch('../backend/artworks/view_artwork.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'artwork_id=' + id
    })
    .then(response => response.json())
    .then(data => {
        closeLoadingModal();
        if (data.success) {
            openEditModal(data.data);
            console.log(data.data)
            
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        closeLoadingModal();
        console.error('Error:', error);
        alert('An error occurred while loading the artwork.');
    });
}

// Open Edit Modal with pre-filled data
function openEditModal(artwork) {
    const modal = document.getElementById('editModalOverlay');
    
    // Pre-fill form fields
    document.getElementById('editArtworkId').value = artwork.artwork_id;
    document.getElementById('editArtworkTitle').value = artwork.artwork_title || '';
    document.getElementById('editArtistName').value = artwork.artist || '';
    document.getElementById('editYearCreated').value = artwork.year_created || '';
    document.getElementById('editMedium').value = artwork.medium || '';
    document.getElementById('editDimension').value = artwork.dimension || '';
    document.getElementById('editCategory').value = artwork.category || '';
    document.getElementById('editOrientation').value = artwork.orientation || '';
    document.getElementById('editStatus').value = artwork.status || '';
    document.getElementById('editArtworkDesc').value = artwork.artwork_desc || '';
    document.getElementById('editArtistDesc').value = artwork.artist_desc || '';
    
    // Show current image
    document.getElementById('editCurrentImage').src = 'uploads/artworks/' + artwork.image;
    document.getElementById('editImagePreview').style.display = 'block';
    document.getElementById('editFileName').textContent = 'Current: ' + artwork.image;
    
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
}

// Close Edit Modal
function closeEditModal() {
    const modal = document.getElementById('editModalOverlay');
    modal.classList.remove('active');
    document.body.style.overflow = 'auto';
    document.getElementById('editArtworkForm').reset();
    document.getElementById('editFileName').textContent = 'No file chosen';
    document.getElementById('editImagePreview').style.display = 'none';
}

// Update file name for edit modal
function updateEditFileName(input) {
    const fileName = input.files[0]?.name || 'No file chosen';
    document.getElementById('editFileName').textContent = fileName;
}

// Submit Edit Form
function submitEditForm() {
    const form = document.getElementById('editArtworkForm');

    if (form.checkValidity()) {
        const formData = new FormData(form);

        const submitBtn = document.querySelector('.btn-edit-submit');
        const originalHTML = submitBtn.innerHTML;
        
        submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Updating...';
        submitBtn.disabled = true;

        fetch('../backend/artworks/edit_artwork.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(text => {
            console.log('Raw response:', text);

            try {
                const data = JSON.parse(text);

                if (data.success) {
                    alert('Artwork updated successfully!');
                    closeEditModal();
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                    submitBtn.innerHTML = originalHTML;
                    submitBtn.disabled = false;
                }
            } catch (err) {
                console.error('JSON parse error:', err);
                alert('Server returned invalid response. Check console for details.');
                console.log('Response text:', text);
                submitBtn.innerHTML = originalHTML;
                submitBtn.disabled = false;
            }
        })
        .catch(error => {
            console.error('Fetch error:', error);
            alert('An error occurred while updating the artwork.');
            submitBtn.innerHTML = originalHTML;
            submitBtn.disabled = false;
        });

    } else {
        form.reportValidity();
    }
}

// Delete Artwork
function deleteArtwork(id) {
    if (confirm('Are you sure you want to delete this artwork? This action cannot be undone.')) {
        
        const container = document.querySelector(`.sample-container[data-id="${id}"]`);
        container.style.opacity = '0.5';
        container.style.pointerEvents = 'none';
        
        fetch('../backend/artworks/delete_artwork.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'artwork_id=' + id
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                container.style.transform = 'scale(0)';
                container.style.transition = 'all 0.3s ease';
                
                setTimeout(() => {
                    container.remove();
                    
                    // Update artwork count
                    const countElement = document.querySelector('.art-count');
                    const currentCount = parseInt(countElement.textContent);
                    countElement.textContent = currentCount - 1;
                    
                    // Check if no artworks left
                    const artworkSection = document.getElementById('artwork-section');
                    if (artworkSection.querySelectorAll('.sample-container').length === 0) {
                        artworkSection.innerHTML = `
                            <div style="grid-column: 1/-1; text-align: center; padding: 60px 20px; color: #666;">
                                <i class="fa-solid fa-image" style="font-size: 4rem; margin-bottom: 20px; opacity: 0.2;"></i>
                                <h3 style="font-size: 1.3rem; margin-bottom: 10px;">No artworks yet</h3>
                                <p style="font-size: 0.95rem;">Click "Add Artwork" to create your first piece.</p>
                            </div>
                        `;
                    }
                }, 200);
                
                alert('Artwork deleted successfully!');
            } else {
                alert('Error: ' + data.message);
                container.style.opacity = '1';
                container.style.pointerEvents = 'auto';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while deleting the artwork.');
            container.style.opacity = '1';
            container.style.pointerEvents = 'auto';
        });
    }
}

// Delete Feedback
function deleteFeedback(id) {
    if (confirm('Are you sure you want to delete this feedback?')) {
        
        const container = document.querySelector(`.feedback-container[data-id="${id}"]`);
        container.style.opacity = '0.5';
        container.style.pointerEvents = 'none';
        
        fetch('../backend/feedback/delete_feedback.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'feedback_id=' + id
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                container.style.transform = 'scale(0)';
                container.style.transition = 'all 0.3s ease';
                
                setTimeout(() => {
                    container.remove();
                    
                    // Check if no feedback left
                    const feedbackSection = document.getElementById('feedback-section');
                    if (feedbackSection.querySelectorAll('.feedback-container').length === 0) {
                        feedbackSection.innerHTML = `
                            <div style="grid-column: 1/-1; text-align: center; padding: 60px 20px; color: #666;">
                                <i class="fa-solid fa-comments" style="font-size: 4rem; margin-bottom: 20px; opacity: 0.2;"></i>
                                <h3 style="font-size: 1.3rem; margin-bottom: 10px;">No feedback yet</h3>
                                <p style="font-size: 0.95rem;">Customer feedback will appear here.</p>
                            </div>
                        `;
                    }
                }, 300);
                
                alert('Feedback deleted successfully!');
            } else {
                alert('Error: ' + data.message);
                container.style.opacity = '1';
                container.style.pointerEvents = 'auto';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while deleting the feedback.');
            container.style.opacity = '1';
            container.style.pointerEvents = 'auto';
        });
    }
}

// Open logout confirmation modal
function openLogoutModal() {
    document.getElementById('logoutModalOverlay').classList.add('active');
    document.body.style.overflow = 'hidden';
}

// Close logout modal
function closeLogoutModal() {
    document.getElementById('logoutModalOverlay').classList.remove('active');
    document.body.style.overflow = 'auto';
}

// Confirm logout and redirect
function confirmLogout() {
    // Show loading state
    const logoutBtn = document.querySelector('.btn-danger');
    logoutBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Logging out...';
    logoutBtn.disabled = true;
    // Call logout.php
    fetch('../backend/logout/logout.php', {
        method: 'POST'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Redirect to login page
             window.location.href = '../backend/logout/logout.php';
        } else {
            alert('Logout failed. Please try again.');
            logoutBtn.innerHTML = originalHTML;
            logoutBtn.disabled = false;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Even if fetch fails, redirect to login (force logout)
        window.location.href = '../AUTHENTICATION/login.php';
    });
}

document.addEventListener('DOMContentLoaded', function() {
    // Add Artwork button
    const addButton = document.querySelector('.add-container');
    if (addButton) {
        addButton.addEventListener('click', openModal);
        addButton.style.cursor = 'pointer';
    }

    // Modal overlays click handlers
    const modalOverlay = document.getElementById('modalOverlay');
    if (modalOverlay) {
        modalOverlay.addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    }

    const editModalOverlay = document.getElementById('editModalOverlay');
    if (editModalOverlay) {
        editModalOverlay.addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });
    }

    const logoutModalOverlay = document.getElementById('logoutModalOverlay');
    if (logoutModalOverlay) {
        logoutModalOverlay.addEventListener('click', function(e) {
            if (e.target === this) {
                closeLogoutModal();
            }
        });
    }

    // Exit button functionality for LOGOUT
    const btnExit = document.getElementById('btn-exit');
    if (btnExit) {
        btnExit.addEventListener('click', function() {
            console.log('Exit button clicked!');
            openLogoutModal();
        });
        btnExit.style.cursor = 'pointer';
    } else {
        console.error('Exit button not found! Make sure your HTML has id="btn-exit"');
    }

    // ESC key handler - handle all modals (SINGLE HANDLER)
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('modalOverlay');
            if (modal && modal.classList.contains('active')) {
                closeModal();
                return;
            }
            
            const viewModal = document.getElementById('viewModalOverlay');
            if (viewModal && viewModal.classList.contains('active')) {
                closeViewModal();
                return;
            }
            
            const editModal = document.getElementById('editModalOverlay');
            if (editModal && editModal.classList.contains('active')) {
                closeEditModal();
                return;
            }

            const logoutModal = document.getElementById('logoutModalOverlay');
            if (logoutModal && logoutModal.classList.contains('active')) {
                closeLogoutModal();
                return;
            }
        }
    });
});