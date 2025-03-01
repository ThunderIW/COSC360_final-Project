document
  .getElementById("signupform")
  .addEventListener("submit", function (event) {
    event.preventDefault();
    submission();
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
        document.forms["loginform"]["email"],
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

function errorPresent(id, message) {
  var error = id.nextElementSibling;
  if (error && error.className == "error") {
    error.textContent = message;
  } else {
    error = document.createTextNode(message);
    var div = document.createElement("div");
    div.className = "error";
    div.appendChild(error);
    id.parentNode.insertBefore(div, id.nextSibling);
  }
}

function submission() {
  if (!verify()) {
    return;
  }
  alert("You have signed up!");
  document.forms["signupform"].reset();
  window.location.href = "../src/homePage.html";
}
