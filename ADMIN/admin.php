<?php
// Fetch data from database
require_once "../backend/connection/connect.php";

// Get all artworks
$artwork_query = "SELECT * FROM artwork ORDER BY artwork_id DESC";
$artwork_result = $conn->query($artwork_query);

// Get artwork count
$count_query = "SELECT COUNT(*) as total FROM artwork";
$count_result = $conn->query($count_query);
$artwork_count = $count_result->fetch_assoc()['total'];

// Get all feedback (if feedback table exists)
$feedback_result = null;
$feedback_query = "SELECT * FROM feedback ORDER BY feedback_id DESC";
if ($conn->query("SHOW TABLES LIKE 'feedback'")->num_rows > 0) {
    $feedback_result = $conn->query($feedback_query);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Page</title>
        <link rel="stylesheet" href="admin.css">
        <!-- <script src="device_check.js"></script> -->
        <script src="admin.js" defer></script>
        <script src="https://kit.fontawesome.com/2972950e8f.js" crossorigin="anonymous"></script>
        
    </head>
    <body>
        <script>
         console.log('Admin.php loaded');
        console.log('Window width:', window.innerWidth);
        console.log('User agent:', navigator.userAgent);
        
        (function() {
            // Prevent redirect loop - check if we just came from desktop_only.php
            if (sessionStorage.getItem('from_desktop_only') === 'true') {
                console.log('Just redirected from desktop_only.php - staying here');
                sessionStorage.removeItem('from_desktop_only');
                return;
            }
            
            function isMobileOrTablet() {
                if (window.innerWidth < 1024) {
                    console.log('Width check: Mobile/Tablet detected');
                    return true;
                }
                
                const userAgent = navigator.userAgent.toLowerCase();
                const mobileKeywords = ['android', 'webos', 'iphone', 'ipad', 'ipod', 'blackberry', 'windows phone'];
                
                const isMobile = mobileKeywords.some(keyword => userAgent.includes(keyword));
                console.log('User agent check:', isMobile);
                return isMobile;
            }
            
            if (isMobileOrTablet()) {
                console.log('Redirecting to desktop_only.php');
                sessionStorage.setItem('from_admin', 'true');
                window.location.href = 'desktop_only.php';
            } else {
                console.log('Desktop device - staying on admin page');
            }
            
            // Check on window resize
            let resizeTimer;
            window.addEventListener('resize', function() {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(function() {
                    console.log('Window resized to:', window.innerWidth);
                    if (window.innerWidth < 1024) {
                        console.log('Resized to mobile width - redirecting to desktop_only.php...');
                        sessionStorage.setItem('from_admin', 'true');
                        window.location.href = 'desktop_only.php';
                    }
                }, 250); // Debounce to prevent multiple redirects
            });
        })();
        </script>
        <section class="main-section">
            <div class="left-side-bar">
                <div class="title-admin-dashboard">
                    <h2>Dashboard</h2>
                </div>
                <div class="btn-container active" id="btn-artworks">
                    <div class="icon-container">
                        <i class="fa-solid fa-paintbrush"></i>
                    </div>
                    <div class="btn-name">
                        <h3>Artworks</h3>
                    </div>
                </div>
                <div class="btn-container" id="btn-feedback">
                    <div class="icon-container">
                        <i class="fa-solid fa-note-sticky"></i>
                    </div>
                    <div class="btn-name">
                        <h3>Feedbacks</h3>
                    </div>
                </div>
                <div class="btn-container" id="btn-exit">
                    <div class="icon-container">
                        <i class="fa-solid fa-door-open"></i>
                    </div>
                    <div class="btn-name">
                        <h3>Exit</h3>
                    </div>
                </div>
                <div class="user-container">
                    <div class="user-info-container">
                        <div class="user-icon-container">
                            <i class="fa-solid fa-circle-user"></i>
                        </div>
                         <div class="user-info">
                            <h3>ADMIN</h3>
                            <h4>Kyran Solomon</h4>
                         </div>
                    </div>
                </div>
            </div>

            <div class="content-div">
                <!-- header container -->
                <div class="header-container">
                    <div class="art-count-container">
                        <div class="art-count-icon-container">
                            <i class="fa-solid fa-chart-line"></i>
                        </div>
                        <div class="count-container">
                            <h3>Artwork Count : <span class="art-count"><?php echo $artwork_count; ?></span></h3>
                        </div>
                    </div>
                    <div class="add-artwork-btn-container">
                        <div class="add-container">
                            <div class="add-icon-container">
                                <i class="fa-solid fa-plus"></i>
                            </div>
                            <div class="add-btn-container">
                                <h3>Add Artwork</h3>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <!-- content containers -->
                 <div class="main-content-container">
                    <!-- artwork collection title -->
                     <div class="artwork-collection-title active" id="artwork-title">
                        <h2>Artwork Collection</h2>
                     </div>
                    <div class="content-container active" id="artwork-section">
                        
                        <?php 
                        // Loop through all artworks and display them
                        if ($artwork_result && $artwork_result->num_rows > 0) {
                            while($row = $artwork_result->fetch_assoc()) {
                        ?>
                        
                        <div class="sample-container" data-id="<?php echo $row['artwork_id']; ?>">
                            <img src="uploads/artworks/<?php echo htmlspecialchars($row['image']); ?>" 
                                 alt="<?php echo htmlspecialchars($row['artwork_title']); ?>">
                            <div class="sample-container-content">
                                <h3 class="artwork-title"><?php echo htmlspecialchars($row['artwork_title']); ?></h3>
                                <p class="artwork-desc"><?php echo htmlspecialchars($row['artwork_desc']); ?></p>
                            </div>
                            <div class="artwork-control-container">
                                <i class="fa-solid fa-eye" onclick="viewArtwork(<?php echo $row['artwork_id']; ?>)" title="View"></i>
                                <i class="fa-solid fa-pen" onclick="editArtwork(<?php echo $row['artwork_id']; ?>)" title="Edit"></i>
                                <i class="fa-solid fa-trash" onclick="deleteArtwork(<?php echo $row['artwork_id']; ?>)" title="Delete"></i>
                            </div>
                        </div>
                        
                        <?php 
                            }
                        } else {
                            // No artworks found
                            echo '<div style="grid-column: 1/-1; text-align: center; padding: 60px 20px; color: #666;">
                                    <i class="fa-solid fa-image" style="font-size: 4rem; margin-bottom: 20px; opacity: 0.2;"></i>
                                    <h3 style="font-size: 1.3rem; margin-bottom: 10px;">No artworks yet</h3>
                                    <p style="font-size: 0.95rem;">Click "Add Artwork" to create your first piece.</p>
                                  </div>';
                        }
                        ?>

                    </div>

                    <!-- feedback title -->
                     <div class="artwork-collection-title feedback" id="feedback-title">
                        <h2>Feedback</h2>
                        <p>Manage review and feedback!</p>
                     </div>
                    <div class="content-container content-feedback " id="feedback-section">
                        
                        <?php 
                        // Loop through all feedback and display them
                        if ($feedback_result && $feedback_result->num_rows > 0) {
                            while($feedback = $feedback_result->fetch_assoc()) {
                        ?>
                        
                        <div class="feedback-container" data-id="<?php echo $feedback['feedback_id']; ?>">
                            <div class="feedback-info">
                                <h2 class="feedback-name"><?php echo htmlspecialchars($feedback['name']); ?></h2>
                                <p class="feedback-desc"><?php echo htmlspecialchars($feedback['feedback_desc']); ?></p>
                            </div>
                            <div class="feedback-control">
                                <i class="fa-solid fa-trash" onclick="deleteFeedback(<?php echo $feedback['feedback_id']; ?>)" title="Delete"></i>
                            </div>
                        </div>
                        
                        <?php 
                            }
                        } else {
                            // No feedback found
                            echo '<div style="grid-column: 1/-1; text-align: center; padding: 60px 20px; color: #666;">
                                    <i class="fa-solid fa-comments" style="font-size: 4rem; margin-bottom: 20px; opacity: 0.2;"></i>
                                    <h3 style="font-size: 1.3rem; margin-bottom: 10px;">No feedback yet</h3>
                                    <p style="font-size: 0.95rem;">Customer feedback will appear here.</p>
                                  </div>';
                        }
                        ?>
                        
                    </div>
                 </div>
                

                 <!-- pop up -->
                <div class="modal-overlay" id="modalOverlay">
                    <div class="modal-container">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h2><i class="fa-solid fa-palette"></i> Add New Artwork</h2>
                            <button class="close-btn" onclick="closeModal()">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body">
                            <form id="artworkForm" enctype="multipart/form-data">
                                <div class="form-grid">
                                    <!-- Artwork Title -->
                                    <div class="form-group full-width">
                                        <label for="artworkTitle">
                                            Artwork Title <span class="required">*</span>
                                        </label>
                                        <input 
                                            type="text" 
                                            id="artworkTitle" 
                                            name="artworkTitle" 
                                            placeholder="Enter artwork title"
                                            required
                                        >
                                    </div>

                                    <!-- Artist Name -->
                                    <div class="form-group">
                                        <label for="artistName">
                                            Artist Name <span class="required">*</span>
                                        </label>
                                        <input 
                                            type="text" 
                                            id="artistName" 
                                            name="artistName" 
                                            placeholder="Enter artist name"
                                            required
                                        >
                                    </div>

                                    <!-- Year Created -->
                                    <div class="form-group">
                                        <label for="yearCreated">
                                            Year Created <span class="required">*</span>
                                        </label>
                                        <input 
                                            type="number" 
                                            id="yearCreated" 
                                            name="yearCreated" 
                                            placeholder="e.g., 2024"
                                            min="1800"
                                            max="2100"
                                            required
                                        >
                                    </div>

                                    <!-- Medium -->
                                    <div class="form-group">
                                        <label for="medium">
                                            Medium <span class="required">*</span>
                                        </label>
                                        <input 
                                            type="text" 
                                            id="medium" 
                                            name="medium" 
                                            placeholder="e.g., Oil on Canvas"
                                            required
                                        >
                                    </div>

                                    <!-- Dimension -->
                                    <div class="form-group">
                                        <label for="dimension">
                                            Dimension <span class="required">*</span>
                                        </label>
                                        <input 
                                            type="text" 
                                            id="dimension" 
                                            name="dimension" 
                                            placeholder='e.g., 24" x 36"'
                                            required
                                        >
                                    </div>

                                    <!-- Category -->
                                    <div class="form-group">
                                        <label for="category">
                                            Category <span class="required">*</span>
                                        </label>
                                        <input 
                                            type="text" 
                                            id="category" 
                                            name="category" 
                                            placeholder="e.g., Abstract, Contemporary"
                                            required
                                        >
                                    </div>

                                    <!-- Orientation -->
                                    <div class="form-group">
                                        <label for="orientation">
                                            Orientation <span class="required">*</span>
                                        </label>
                                        <select id="orientation" name="orientation" required>
                                            <option value="">Select orientation</option>
                                            <option value="Landscape">Landscape</option>
                                            <option value="Portrait">Portrait</option>
                                            <option value="Square">Square</option>
                                        </select>
                                    </div>

                                    <!-- Status -->
                                    <div class="form-group">
                                        <label for="status">
                                            Status <span class="required">*</span>
                                        </label>
                                        <select id="status" name="status" required>
                                            <option value="">Select status</option>
                                            <option value="National">National</option>
                                            <option value="Local">Local</option>
                                        </select>
                                    </div>

                                    <!-- Artwork Description -->
                                    <div class="form-group full-width">
                                        <label for="artworkDesc">
                                            Artwork Description <span class="required">*</span>
                                        </label>
                                        <textarea 
                                            id="artworkDesc" 
                                            name="artworkDesc" 
                                            placeholder="Enter a detailed description of the artwork"
                                            required
                                        ></textarea>
                                    </div>

                                    <!-- Artist Description -->
                                    <div class="form-group full-width">
                                        <label for="artistDesc">
                                            Artist Description/Bio <span class="required">*</span>
                                        </label>
                                        <textarea 
                                            id="artistDesc" 
                                            name="artistDesc" 
                                            placeholder="Enter artist biography or description"
                                            required
                                        ></textarea>
                                    </div>

                                    <!-- Image Upload -->
                                    <div class="form-group full-width">
                                        <label for="artworkImage">
                                            Artwork Image <span class="required">*</span>
                                        </label>
                                        <div class="file-input-wrapper">
                                            <input 
                                                type="file" 
                                                id="artworkImage" 
                                                name="artworkImage" 
                                                accept="image/*"
                                                onchange="updateFileName(this)"
                                                required
                                            >
                                            <label for="artworkImage" class="file-input-label">
                                                <i class="fa-solid fa-cloud-arrow-up"></i>
                                                <span>Choose Image File</span>
                                            </label>
                                        </div>
                                        <div class="file-name" id="fileName">No file chosen</div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button class="btn btn-cancel" onclick="closeModal()">
                                <i class="fa-solid fa-xmark"></i>
                                Cancel
                            </button>
                            <button class="btn btn-submit" onclick="submitForm()">
                                <i class="fa-solid fa-check"></i>
                                Add Artwork
                            </button>
                        </div>
                    </div>
                </div>

            </div>

            <!-- edit modal -->
            <div class="modal-overlay" id="editModalOverlay">
                <div class="modal-container">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h2><i class="fa-solid fa-pen"></i> Edit Artwork</h2>
                        <button class="close-btn" onclick="closeEditModal()">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <form id="editArtworkForm" enctype="multipart/form-data">
                            <!-- Hidden field for artwork ID -->
                            <input type="hidden" id="editArtworkId" name="artworkId">
                            
                            <div class="form-grid">
                                <!-- Artwork Title -->
                                <div class="form-group full-width">
                                    <label for="editArtworkTitle">
                                        Artwork Title <span class="required">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        id="editArtworkTitle" 
                                        name="artworkTitle" 
                                        placeholder="Enter artwork title"
                                        required
                                    >
                                </div>

                                <!-- Artist Name -->
                                <div class="form-group">
                                    <label for="editArtistName">
                                        Artist Name <span class="required">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        id="editArtistName" 
                                        name="artistName" 
                                        placeholder="Enter artist name"
                                        required
                                    >
                                </div>

                                <!-- Year Created -->
                                <div class="form-group">
                                    <label for="editYearCreated">
                                        Year Created <span class="required">*</span>
                                    </label>
                                    <input 
                                        type="number" 
                                        id="editYearCreated" 
                                        name="yearCreated" 
                                        placeholder="e.g., 2024"
                                        min="1800"
                                        max="2100"
                                        required
                                    >
                                </div>

                                <!-- Medium -->
                                <div class="form-group">
                                    <label for="editMedium">
                                        Medium <span class="required">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        id="editMedium" 
                                        name="medium" 
                                        placeholder="e.g., Oil on Canvas"
                                        required
                                    >
                                </div>

                                <!-- Dimension -->
                                <div class="form-group">
                                    <label for="editDimension">
                                        Dimension <span class="required">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        id="editDimension" 
                                        name="dimension" 
                                        placeholder='e.g., 24" x 36"'
                                        required
                                    >
                                </div>

                                <!-- Category -->
                                <div class="form-group">
                                    <label for="editCategory">
                                        Category <span class="required">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        id="editCategory" 
                                        name="category" 
                                        placeholder="e.g., Abstract, Contemporary"
                                        required
                                    >
                                </div>

                                <!-- Orientation -->
                                <div class="form-group">
                                    <label for="editOrientation">
                                        Orientation <span class="required">*</span>
                                    </label>
                                    <select id="editOrientation" name="orientation" required>
                                        <option value="">Select orientation</option>
                                        <option value="Landscape">Landscape</option>
                                        <option value="Portrait">Portrait</option>
                                        <option value="Square">Square</option>
                                    </select>
                                </div>

                                <!-- Status -->
                                <div class="form-group">
                                    <label for="editStatus">
                                        Status <span class="required">*</span>
                                    </label>
                                    <select id="editStatus" name="status" required>
                                        <option value="">Select status</option>
                                        <option value="National">National</option>
                                        <option value="Local">Local</option>
                                    </select>
                                </div>

                                <!-- Artwork Description -->
                                <div class="form-group full-width">
                                    <label for="editArtworkDesc">
                                        Artwork Description <span class="required">*</span>
                                    </label>
                                    <textarea 
                                        id="editArtworkDesc" 
                                        name="artworkDesc" 
                                        placeholder="Enter a detailed description of the artwork"
                                        required
                                    ></textarea>
                                </div>

                                <!-- Artist Description -->
                                <div class="form-group full-width">
                                    <label for="editArtistDesc">
                                        Artist Description/Bio <span class="required">*</span>
                                    </label>
                                    <textarea 
                                        id="editArtistDesc" 
                                        name="artistDesc" 
                                        placeholder="Enter artist biography or description"
                                        required
                                    ></textarea>
                                </div>

                                <!-- Current Image Preview -->
                                <div class="form-group full-width" id="editImagePreview" style="display: none;">
                                    <label>Current Image</label>
                                    <div style="padding: 10px; background: #f8f9fa; border-radius: 8px; text-align: center;">
                                        <img id="editCurrentImage" src="" alt="Current artwork" style="max-width: 200px; max-height: 200px; border-radius: 8px; border: 2px solid #e2e8f0;">
                                    </div>
                                </div>

                                <!-- Image Upload (Optional for edit) -->
                                <div class="form-group full-width">
                                    <label for="editArtworkImage">
                                        Change Artwork Image <span style="color: #666; font-weight: 400;">(Optional - leave empty to keep current image)</span>
                                    </label>
                                    <div class="file-input-wrapper">
                                        <input 
                                            type="file" 
                                            id="editArtworkImage" 
                                            name="artworkImage" 
                                            accept="image/*"
                                            onchange="updateEditFileName(this)"
                                        >
                                        <label for="editArtworkImage" class="file-input-label">
                                            <i class="fa-solid fa-cloud-arrow-up"></i>
                                            <span>Choose New Image File</span>
                                        </label>
                                    </div>
                                    <div class="file-name" id="editFileName">No file chosen</div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button class="btn btn-cancel" onclick="closeEditModal()">
                            <i class="fa-solid fa-xmark"></i>
                            Cancel
                        </button>
                        <button class="btn btn-submit btn-edit-submit" onclick="submitEditForm()">
                            <i class="fa-solid fa-check"></i>
                            Update Artwork
                        </button>
                    </div>
                </div>
            </div>

            <!-- Logout Confirmation Modal -->
            <div class="modal-overlay" id="logoutModalOverlay">
                <div class="modal-container logout-modal">
                    <div class="modal-header">
                        <h2><i class="fa-solid fa-right-from-bracket"></i> Confirm Logout</h2>
                    </div>

                    <div class="modal-body">
                        <div style="text-align: center; padding: 20px 0;">
                            <i class="fa-solid fa-circle-exclamation" style="font-size: 4rem; color: #f59e0b; margin-bottom: 20px;"></i>
                            <h3 style="font-size: 1.3rem; margin-bottom: 10px; color: #1f2937;">Are you sure you want to logout?</h3>
                            <p style="color: #6b7280; font-size: 0.95rem;">You will be redirected to the login page.</p>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-cancel" onclick="closeLogoutModal()">
                            <i class="fa-solid fa-xmark"></i>
                            Cancel
                        </button>
                        <button class="btn btn-danger" onclick="confirmLogout()">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            Yes, Logout
                        </button>
                    </div>
                </div>
            </div>

        </section>


    </body>
</html>
<?php
// Close database connection
$conn->close();
?>