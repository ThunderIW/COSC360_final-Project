document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form[action='updateProfile.php']");
    const passwordInput = document.getElementById("password");
    const confirmPasswordInput = document.getElementById("confirm_password");

    if (!form || !passwordInput || !confirmPasswordInput) {
        console.log("⚠️ Missing form or inputs.");
        return;
    }

    const errorMessage = document.createElement("p");
    errorMessage.textContent = "⚠️ Passwords do not match.";
    errorMessage.classList.add("password-error");
    errorMessage.style.color = "red";
    errorMessage.style.fontWeight = "bold";
    errorMessage.style.marginTop = "5px";
    errorMessage.style.display = "none";

    confirmPasswordInput.insertAdjacentElement("afterend", errorMessage);

    // Listen for input
    passwordInput.addEventListener("input", validate);
    confirmPasswordInput.addEventListener("input", validate);

    form.addEventListener("submit", function (e) {
        if (!validate()) {
            console.log("🚫 Form blocked - passwords do not match.");
            e.preventDefault();
        }
    });

    function validate() {
        const password = passwordInput.value.trim();
        const confirmPassword = confirmPasswordInput.value.trim();

        const isMatch = password === confirmPassword;
        const isEmpty = password === "" || confirmPassword === "";

        // Clear all states first
        passwordInput.classList.remove("error-border", "success-border");
        confirmPasswordInput.classList.remove("error-border", "success-border");

        if (isEmpty) {
            errorMessage.style.display = "none";
            return true;
        }

        if (!isMatch) {
            passwordInput.classList.add("error-border");
            confirmPasswordInput.classList.add("error-border");
            errorMessage.style.display = "block";
            return false;
        } else {
            passwordInput.classList.add("success-border");
            confirmPasswordInput.classList.add("success-border");
            errorMessage.style.display = "none";
            return true;
        }
    }
});
