const userMenu=document.getElementById("user-menu-button");
const userDropdown=document.getElementById("user-dropdown");

userMenu.addEventListener("click", () => {
    userDropdown.classList.toggle("hidden");
})