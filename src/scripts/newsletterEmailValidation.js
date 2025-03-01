document.getElementById("newsletterSubmit").addEventListener("click", function(event) {
    let emailInput = document.getElementById("email").value.trim();
    let errorMessage = "";

    if (emailInput === "") {
        errorMessage = "Email field cannot be empty.";
    } else if (!emailInput.includes("@")) {
        errorMessage = "Email must contain '@'.";
    } else {
        let parts = emailInput.split("@");
        if (parts.length !== 2 || parts[1].indexOf(".") === -1) {
            errorMessage = "Email must contain a '.' after '@'.";
        }
    }

    if (errorMessage) {
        event.preventDefault();
        alert(errorMessage);
    } else {
        alert("Subscription successful!");
    }
});
