const form = document.getElementById('contact-form');
const userFirstName = document.getElementById("first-name");
const userLastName = document.getElementById("last-name");
const userEmail = document.getElementById("email");
const messageToSend = document.getElementById("message");
const phoneNumber = document.getElementById("phone");

form.addEventListener('submit', (e) => {
    let isValid = true;

    // Remove all previous error messages before validation
    document.querySelectorAll(".error-message").forEach(el => el.remove());
    document.querySelectorAll(".border-red-500").forEach(el => el.classList.remove("border-red-500"));

    if (userFirstName.value.trim() === "") {
        showError(userFirstName, "Please enter your first name!");
        isValid = false;
    }

    if (userLastName.value.trim() === "") {
        showError(userLastName, "Please enter your last name!");
        isValid = false;
    }

    if (userEmail.value.trim() === "") {
        showError(userEmail, "Please enter your email!");
        isValid = false;
    } else if (!validateEmail(userEmail.value)) {
        showError(userEmail, "Please enter a valid email address!");
        isValid = false;
    }

    if (messageToSend.value.trim() === "") {
        showError(messageToSend, "Please enter your message!");
        isValid = false;
    }

    if (phoneNumber.value.trim() === "" || phoneNumber.value.length < 10) {
        showError(phoneNumber, "Please enter a valid phone number!");
        isValid = false;
    }

    if (!isValid) {
        e.preventDefault(); // Stop form submission if validation fails
    }
});

// Function to Show Errors (Prevents Duplicate Messages)
function showError(inputElement, message) {
    // Remove existing error message for this input
    if (inputElement.nextElementSibling && inputElement.nextElementSibling.classList.contains("error-message")) {
        inputElement.nextElementSibling.remove();
    }

    const errorDiv = document.createElement("div");
    errorDiv.classList.add("text-red-500", "font-bold", "mt-1", "error-message");
    errorDiv.textContent = message;

    inputElement.classList.add("border-red-500");
    inputElement.insertAdjacentElement("afterend", errorDiv);
}

// Function to Validate Email Format
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

// Remove Errors on Input
let inputs = document.querySelectorAll('input, textarea');
inputs.forEach(input => {
    input.addEventListener('input', () => {
        if (input.nextElementSibling && input.nextElementSibling.classList.contains('error-message')) {
            input.nextElementSibling.remove();
        }
        input.classList.remove('border-red-500');
    });
});
