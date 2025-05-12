// profile.js

document.addEventListener("DOMContentLoaded", function () {
  console.log("Profile Page Loaded");

  // Handle profile form submission (for demo purposes)
  const profileForm = document.getElementById("profileForm");
  profileForm.addEventListener("submit", function (e) {
    e.preventDefault();
    const name = document.getElementById("name").value;
    const bio = document.getElementById("bio").value;
    const profilePic = document.getElementById("profilePic").files[0];

    // Placeholder: simulate saving changes
    console.log("Profile Updated:", { name, bio, profilePic });

    // Show a success message (you can customize this)
    alert("Profile updated successfully!");
  });

  // Handle password form submission
  const passwordForm = document.getElementById("passwordForm");
  passwordForm.addEventListener("submit", function (e) {
    e.preventDefault();

    const currentPassword = document.getElementById("currentPassword").value;
    const newPassword = document.getElementById("newPassword").value;
    const confirmPassword = document.getElementById("confirmPassword").value;

    // Simple validation for matching passwords
    if (newPassword !== confirmPassword) {
      alert("New passwords don't match!");
      return;
    }

    // Placeholder: simulate password change
    console.log("Password Changed:", { currentPassword, newPassword });

    // Show a success message
    alert("Password changed successfully!");
  });
});
