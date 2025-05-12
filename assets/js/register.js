// register.js

document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("register-form");

  // Handle form submission
  form.addEventListener("submit", function (e) {
    e.preventDefault();

    // Get form data
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirm-password").value;

    // Validate password match
    if (password !== confirmPassword) {
      alert("Passwords do not match.");
      return;
    }

    // Log the form data (replace with actual registration logic)
    console.log({
      name,
      email,
      password,
    });

    // Feedback to the user
    alert("Registering user...");

    // Clear the form (Optional, after submission)
    form.reset();
  });
});
