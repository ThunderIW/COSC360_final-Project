document
  .getElementById("loginform")
  .addEventListener("submit", function (event) {
    event.preventDefault();
    submission();
  });

function verify() {
  let username = document.forms["loginform"]["username"].value;
  let password = document.forms["loginform"]["password"].value;

  if (username == "" || password == "") {
    if (username == "") {
      errorPresent(
        document.forms["loginform"]["username"],
        "You need to enter your username!"
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
