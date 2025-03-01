document
  .getElementById("loginform")
  .addEventListener("submit", function (event) {
    event.preventDefault();
    submission();
  });

function verify() {
  let email = document.forms["loginform"]["email"].value;
  let password = document.forms["loginform"]["password"].value;

  if (!verifyEmail(email) || email == "" || password == "") {
    if (email == "") {
      errorPresent(
        document.forms["loginform"]["email"],
        "You need to enter your email!"
      );
    }

    if (!verifyEmail(email)) {
      errorPresent(
        document.forms["loginform"]["email"],
        "You need to enter a valid email!"
      );
    }

    if (password == "") {
      errorPresent(
        document.forms["loginform"]["password"],
        "You need to enter your password!"
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
  alert("You have been logged in!");
  document.forms["loginform"].reset();
  window.location.href = "../src/homePage.html";
}
