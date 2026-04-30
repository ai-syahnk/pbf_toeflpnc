document.addEventListener('DOMContentLoaded', function() {
    // Dropdown User Toggle
    const userAvatarToggle = document.getElementById('userAvatarToggle');
    const userDropdown = document.getElementById('userDropdown');

    if (userAvatarToggle && userDropdown) {
        userAvatarToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            userDropdown.classList.toggle('show');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!userAvatarToggle.contains(e.target)) {
                userDropdown.classList.remove('show');
            }
        });
    }

    // Navbar scroll effect
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('shadow-sm');
                navbar.style.padding = '0.5rem 0';
            } else {
                navbar.classList.remove('shadow-sm');
                navbar.style.padding = '1rem 0';
            }
        });
    }
});
