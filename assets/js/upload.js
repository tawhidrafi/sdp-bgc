// upload.js

document.addEventListener("DOMContentLoaded", function () {
  console.log("Upload Page Loaded");

  const uploadForm = document.getElementById("uploadForm");
  const previewTitle = document.getElementById("preview-title");
  const previewDescription = document.getElementById("preview-description");
  const previewFile = document.getElementById("preview-file");

  // Handle the form submission
  uploadForm.addEventListener("submit", function (e) {
    e.preventDefault();

    // Get the form values
    const title = document.getElementById("title").value;
    const description = document.getElementById("description").value;
    const category = document.getElementById("category").value;
    const file = document.getElementById("file").files[0];

    // Simple validation (make sure there's a file selected)
    if (!file) {
      alert("Please select a file to upload.");
      return;
    }

    // Update the preview section with the entered data
    previewTitle.textContent = title;
    previewDescription.textContent = description;
    previewFile.textContent = file.name;

    // Placeholder: simulate successful upload
    alert("Content uploaded successfully!");

    // Optionally, reset form after successful upload
    uploadForm.reset();
  });
});
