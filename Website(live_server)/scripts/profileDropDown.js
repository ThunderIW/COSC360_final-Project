document.addEventListener("DOMContentLoaded", () => {
    const userMenu = document.getElementById("user-menu-button");
    const userDropdown = document.getElementById("user-dropdown");

    if (!userMenu || !userDropdown) {
        console.error("Dropdown elements not found.");
        return;
    }

    // Toggle dropdown on button click
    userMenu.addEventListener("click", (event) => {
        event.stopPropagation(); // Prevent immediate closing
        userDropdown.classList.toggle("show"); // Toggle dropdown visibility
    });

    // Close dropdown when clicking outside
    document.addEventListener("click", (event) => {
        if (!userMenu.contains(event.target) && !userDropdown.contains(event.target)) {
            userDropdown.classList.remove("show");
        }
    });

    // Close dropdown when pressing the Escape key
    document.addEventListener("keydown", (event) => {
        if (event.key === "Escape") {
            userDropdown.classList.remove("show");
        }
    });
});
