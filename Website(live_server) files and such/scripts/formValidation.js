

const form = document.getElementById('contact-form');
const userName = document.getElementById("name");
const userEmail = document.getElementById("email");
const messageToSend = document.getElementById("message");
const phoneNumber = document.getElementById("phone");

form.addEventListener('submit', (e) => {
    let isValid = true;

    // Remove all previous error messages before validation
    document.querySelectorAll(".error-message").forEach(el => el.remove());
    document.querySelectorAll(".error-border").forEach(el => el.classList.remove("error-border"));

    if (userName.value.trim() === "") {
        showError(userName, "Please enter your full name!");
        isValid = false;
    }

    if (userEmail.value.trim() === "") {
        showError(userEmail, "Please enter your email!");
        isValid = false;
    } 
    else if (!validateEmail(userEmail.value)) {
    
        showError(userEmail, "Please enter a valid email address!");
        isValid = false;
    }

    if (messageToSend.value.trim() === "") {
        showError(messageToSend, "Please enter your message!");
        isValid = false;
    }

    if (!validatePhone(phoneNumber.value)) {
        showError(phoneNumber, "Please enter a valid phone number (e.g., 123-456-7890)!");
        isValid = false;
    }

    if (!isValid) {
        e.preventDefault(); // Stop form submission if validation fails
    }
});

// Function to Show Errors (Prevents Duplicate Messages)
function showError(inputElement, message) {
    if (inputElement.nextElementSibling && inputElement.nextElementSibling.classList.contains("error-message")) {
        inputElement.nextElementSibling.remove();
    }

    const errorDiv = document.createElement("div");
    //errorDiv.classList.add("text-red-500", "font-bold", "mt-1", "error-message");
    errorDiv.textContent = message;
    errorDiv.classList.add("error-message");

    inputElement.classList.add("error-border");
    inputElement.insertAdjacentElement("afterend", errorDiv);
}

// Function to Validate Email Format
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

// Function to Validate Phone Number Format (e.g., 123-456-7890)
function validatePhone(phone) {
    const phoneRegex = /^\d{3}-\d{3}-\d{4}$/;
    return phoneRegex.test(phone.trim());
}

// Remove Errors on Input
let inputs = document.querySelectorAll('input, textarea');
inputs.forEach(input => {
    input.addEventListener('input', () => {
        if (input.nextElementSibling && input.nextElementSibling.classList.contains('error-message')) {
            input.nextElementSibling.remove();
        }
        input.classList.remove('error-border');
    });
});
