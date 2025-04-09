document.getElementById("newsletterSubmit").addEventListener("click", (event) => {
    event.preventDefault(); // Prevent form submission if invalid

    const userEmail = document.getElementById("email");
    const emailValue = userEmail.value.trim();
    const emailError = userEmail.nextElementSibling;
    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/; // Email regex validation

    // Remove previous error messages
    if (emailError && emailError.classList.contains("error-message")) {
        emailError.remove();
    }

    if (emailValue === "") {
        showError(userEmail, "Please enter your email!");
        return;
    } 

    if (!emailPattern.test(emailValue)) {
        showError(userEmail, "Please enter a valid email address!");
        return;
    }

    // Email is valid, remove error styles and submit form
    userEmail.classList.remove("error-border");
    //alert("Form submitted successfully!");
});

function showError(inputElement, message) {
    const errorDiv = document.createElement("div");
    errorDiv.textContent = message;
    errorDiv.classList.add("error-message");

    inputElement.classList.add("error-border");
    inputElement.insertAdjacentElement("afterend", errorDiv);
}

// Clear error message on user input
document.getElementById("email").addEventListener("input", (event) => {
    const input = event.target;
    if (input.nextElementSibling && input.nextElementSibling.classList.contains("error-message")) {
        input.nextElementSibling.remove();
    }
    input.classList.remove("error-border");
});
