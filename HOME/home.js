// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded');
    
    // Load latest feedback when page loads
    loadLatestFeedback();
    
    // Get the form element
    const feedbackForm = document.querySelector('.whistleblowers-cont form');
    
    console.log('Form found:', feedbackForm);

    if (feedbackForm) {
        feedbackForm.addEventListener('submit', function(e) {
            console.log('Form submit event triggered');
            e.preventDefault(); // Prevent default form submission
            e.stopPropagation(); // Stop event from bubbling up
            
            console.log('Default prevented, starting AJAX submission');
            
            // Get form data
            const formData = new FormData(this);
            
            // Log form data for debugging
            console.log('Form data:', {
                name: formData.get('name'),
                email: formData.get('email'),
                feedback: formData.get('feedback')
            });
            
            // Get submit button
            const submitBtn = this.querySelector('input[type="submit"]');
            const originalValue = submitBtn.value;
            
            // Disable button and show loading state
            submitBtn.value = 'Submitting...';
            submitBtn.disabled = true;
            
            // Submit form via fetch
            fetch('../backend/home/submit_feedback.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                console.log('Response received:', response);
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data);
                if (data.success) {
                    // Show success message
                    alert(data.message);
                    
                    // Clear the form
                    feedbackForm.reset();
                    
                    // Reload latest feedback after submission
                    setTimeout(() => {
                        loadLatestFeedback();
                    }, 500);
                } else {
                    // Show error message
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
                alert('An error occurred while submitting your feedback. Please try again.');
            })
            .finally(() => {
                // Re-enable button in all cases
                submitBtn.value = originalValue;
                submitBtn.disabled = false;
            });
            
            return false; // Extra prevention of default behavior
        });
        
        console.log('Event listener attached successfully');
    } else {
        console.error('Feedback form not found!');
    }
});

// Function to load latest feedback
function loadLatestFeedback() {
    console.log('Loading latest feedback...');
    
    fetch('../backend/home/fetch_latest_feedback.php')
        .then(response => {
            console.log('Feedback response status:', response.status);
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Feedback data received:', data);
            
            const feedbackContainer = document.querySelector('.latest-feedback-texts');
            console.log('Feedback container found:', feedbackContainer);
            
            if (!feedbackContainer) {
                console.error('Feedback container not found!');
                return;
            }
            
            if (data.success && data.feedbacks && data.feedbacks.length > 0) {
                // Clear existing feedback
                feedbackContainer.innerHTML = '';
                
                console.log('Creating feedback elements for', data.feedbacks.length, 'items');
                
                // Add new feedback
                data.feedbacks.forEach((feedback, index) => {
                    console.log(`Creating feedback ${index + 1}:`, feedback);
                    
                    const feedbackDiv = document.createElement('div');
                    feedbackDiv.className = 'feedbacks';
                    
                    const nameHeading = document.createElement('h3');
                    nameHeading.textContent = feedback.name;
                    
                    const feedbackText = document.createElement('p');
                    feedbackText.textContent = `"${feedback.feedback}"`;
                    
                    feedbackDiv.appendChild(nameHeading);
                    feedbackDiv.appendChild(feedbackText);
                    feedbackContainer.appendChild(feedbackDiv);
                });
                
                console.log('Feedback loaded successfully!');
            } else {
                console.log('No feedback available');
                feedbackContainer.innerHTML = `
                    <div class="feedbacks">
                        <h3>No Feedback Yet</h3>
                        <p>"Be the first to share your thoughts!"</p>
                    </div>
                `;
            }
        })
        .catch(error => {
            console.error('Error loading feedback:', error);
            const feedbackContainer = document.querySelector('.latest-feedback-texts');
            if (feedbackContainer) {
                feedbackContainer.innerHTML = `
                    <div class="feedbacks">
                        <h3>Error Loading Feedback</h3>
                        <p>"Unable to load feedback at this time."</p>
                    </div>
                `;
            }
        });
}

// Your existing toggle function
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