// login.js

document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("login-form");

  // Handle form submission
  form.addEventListener("submit", function (e) {
    e.preventDefault();

    // Get form data
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    // Log the form data (for now, replace with actual login logic)
    console.log({
      email,
      password,
    });

    // Feedback to the user (you can replace this with actual login logic)
    alert("Logging in...");
  });
});
