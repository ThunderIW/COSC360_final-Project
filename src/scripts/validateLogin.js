document
  .getElementById("loginform")
  .addEventListener("submit", function (event) {
    event.preventDefault();
    submission();
  });

function verify() {
  let email = document.forms["loginform"]["email"];
  let password = document.forms["loginform"]["password"];
  let emailValue = email.value.trim();
  let passwordValue = password.value.trim();
  
  clearErrors(); // Remove existing error messages before revalidating

  let valid = true;

  if (emailValue === "") {
    showError(email, "You need to enter your email!");
    valid = false;
  } else if (!verifyEmail(emailValue)) {
    showError(email, "You need to enter a valid email!");
    valid = false;
  }

  if (passwordValue === "") {
    showError(password, "You need to enter your password!");
    valid = false;
  }

  return valid;
}

function verifyEmail(email) {
  const characters = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return characters.test(email);
}

function showError(inputElement, message) {
  // Remove previous error messages for this field
  if (inputElement.nextElementSibling && inputElement.nextElementSibling.classList.contains("error-message")) {
    inputElement.nextElementSibling.remove();
  }

  // Add red border to input
  inputElement.classList.add("error-border");

  const errorDiv = document.createElement("div");
  errorDiv.textContent = message;
  errorDiv.classList.add("error-message");

  inputElement.insertAdjacentElement("afterend", errorDiv);
}

function clearErrors() {
  document.querySelectorAll(".error-message").forEach(el => el.remove());
  document.querySelectorAll(".error-border").forEach(el => el.classList.remove(".error-border"));
}

function submission() {
  if (!verify()) {
    return;
  }
  alert("You have been logged in!");
  document.forms["loginform"].reset();
  //window.location.href = "../homePage.php";
}


let inputs = document.querySelectorAll('input');
inputs.forEach(input => {
    input.addEventListener('input', () => {
        if (input.nextElementSibling && input.nextElementSibling.classList.contains('error-message')) {
            input.nextElementSibling.remove();
        }
        input.classList.remove('error-border');
    });
});