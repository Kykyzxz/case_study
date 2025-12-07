// Buttons
const btnArtworks = document.getElementById("btn-artworks");
const btnFeedback = document.getElementById("btn-feedback");

// Titles
const artworkTitle = document.getElementById("artwork-title");
const feedbackTitle = document.getElementById("feedback-title");

// Content sections
const artworkSection = document.getElementById("artwork-section");
const feedbackSection = document.getElementById("feedback-section");

// Reset everything
function resetView() {
    // hide titles
    artworkTitle.classList.remove("active");
    feedbackTitle.classList.remove("active");

    // hide content containers
    artworkSection.classList.remove("active");
    feedbackSection.classList.remove("active");

    // remove active styling from buttons
    btnArtworks.classList.remove("active");
    btnFeedback.classList.remove("active");
}

// Show Artworks
btnArtworks.addEventListener("click", () => {
    resetView();
    btnArtworks.classList.add("active");

    artworkTitle.classList.add("active");
    artworkSection.classList.add("active");
});

// Show Feedback
btnFeedback.addEventListener("click", () => {
    resetView();
    btnFeedback.classList.add("active");

    feedbackTitle.classList.add("active");
    feedbackSection.classList.add("active");
});
