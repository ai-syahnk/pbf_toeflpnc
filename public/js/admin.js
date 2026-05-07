document.addEventListener("DOMContentLoaded", function () {
    // Sidebar Toggle
    const sidebar = document.getElementById("sidebar");
    const content = document.getElementById("content");
    const toggleBtn = document.getElementById("sidebarCollapse");

    if (toggleBtn) {
        toggleBtn.addEventListener("click", function () {
            sidebar.classList.toggle("active");
            content.classList.toggle("active");
        });
    }
});
