document.addEventListener('DOMContentLoaded', function() {
    // Sidebar Toggle for Mobile
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    const sidebar = document.querySelector('.sidebar');
    
    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('show');
        });
    }

    // Auto-close alerts after 5 seconds
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert:not(.alert-important)');
        alerts.forEach(function(alert) {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);

    // Dark Mode Toggle
    const themeToggle = document.getElementById('theme-toggle');
    if (themeToggle) {
        // Set initial icon based on theme
        if (localStorage.getItem('adminTheme') === 'dark') {
            themeToggle.innerHTML = '<i class="fa-solid fa-sun"></i>';
        }

        themeToggle.addEventListener('click', function() {
            if (document.documentElement.getAttribute('data-bs-theme') === 'dark') {
                document.documentElement.removeAttribute('data-bs-theme');
                document.documentElement.classList.remove('dark-mode');
                localStorage.setItem('adminTheme', 'light');
                themeToggle.innerHTML = '<i class="fa-solid fa-moon"></i>';
            } else {
                document.documentElement.setAttribute('data-bs-theme', 'dark');
                document.documentElement.classList.add('dark-mode');
                localStorage.setItem('adminTheme', 'dark');
                themeToggle.innerHTML = '<i class="fa-solid fa-sun"></i>';
            }
        });
    }  
});