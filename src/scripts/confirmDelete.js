document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("confirmModal");
    const confirmYes = document.getElementById("confirmYes");
    const confirmNo = document.getElementById("confirmNo");
    const modalText = modal.querySelector("p");

    let currentForm = null;

    document.querySelectorAll("form.delete-user-form").forEach(form => {
        form.addEventListener("submit", function(event) {
            event.preventDefault();
            currentForm = form;

            const userName = form.getAttribute("data-username");
            modalText.textContent = `Are you sure you want to delete user: ${userName}?`;

            modal.style.display = "flex";
        });
    });

    confirmYes.addEventListener("click", () => {
        if (currentForm) {
            currentForm.submit();
            currentForm = null;
        }
        modal.style.display = "none";
    });

    confirmNo.addEventListener("click", () => {
        currentForm = null;
        modal.style.display = "none";
    });

    modal.addEventListener("click", (e) => {
        if (e.target === modal) {
            modal.style.display = "none";
        }
    });
});
