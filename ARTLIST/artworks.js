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

// Add event listeners when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Local artists view buttons
    const localGridBtn = document.querySelector('.local-grid-view');
    const localListBtn = document.querySelector('.local-list-view');

    if (localGridBtn) {
        localGridBtn.addEventListener('click', () => switchLocalView('grid'));
    }

    if (localListBtn) {
        localListBtn.addEventListener('click', () => switchLocalView('list'));
    }

    // Navbar scroll effect
    const navbar = document.querySelector('nav.desktop');
    if (navbar) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    }
});