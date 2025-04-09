document
  .getElementById("signupform")
  .addEventListener("submit", function (event) {
    if(!verify()){
    event.preventDefault();}

  });

function verify() {
  let firstName = document.forms["signupform"]["firstname"].value;
  let lastName = document.forms["signupform"]["lastname"].value;
  let email = document.forms["signupform"]["email"].value;
  let password = document.forms["signupform"]["password"].value;

  if (
    firstName == "" ||
    lastName == "" ||
    !verifyEmail(email) ||
    email == "" ||
    password == ""
  ) {
    if (firstName == "") {
      errorPresent(
        document.forms["signupform"]["firstname"],
        "You need to enter your First Name!"
      );
    }

    if (lastName == "") {
      errorPresent(
        document.forms["signupform"]["lastname"],
        "You need to enter your Last Name!"
      );
    }

    if (email == "") {
      errorPresent(
        document.forms["signupform"]["email"],
        "You need to enter your email!"
      );
    }

    if (!verifyEmail(email)) {
      errorPresent(
        document.forms["signupform"]["email"],
        "You need to enter your Email!"
      );
    }

    if (password == "") {
      errorPresent(
        document.forms["signupform"]["password"],
        "You need to enter your Password!"
      );
    }
    return false;
  }
  return true;
}

function verifyEmail(email) {
  const characters = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return characters.test(email);
}

function errorPresent(inputElement, message) {
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


function submission() {
  if (!verify()) {
    return;
  }
  //alert("You have signed up!");
  //document.forms["signupform"].reset();
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