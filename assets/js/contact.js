// contact.js

document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("contact-form");

  // Handle form submission
  form.addEventListener("submit", function (e) {
    e.preventDefault();

    // Get the form data
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const subject = document.getElementById("subject").value;
    const message = document.getElementById("message").value;

    // Log the form data (for now, you can replace this with actual form submission logic)
    console.log({
      name,
      email,
      subject,
      message,
    });

    // Provide feedback to the user
    alert("Your message has been sent! We will get back to you soon.");
  });
});
