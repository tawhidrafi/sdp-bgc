<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EduMarketHub - User</title>

  <!-- Font Awesome -->
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
    rel="stylesheet" />

  <!-- Stylesheets -->
  <link rel="stylesheet" href="./assets/css/global.css" />
  <link rel="stylesheet" href="./assets/css/profile.css" />
</head>

<body>
  <!-- HEADER -->
  <?php include('./assets/components/user-nav.php'); ?>

  <!-- MAIN CONTENT -->
  <main class="container">
    <section class="profile-section">
      <h2>My Profile</h2>

      <!-- Profile Card -->
      <div class="profile-card">
        <div class="profile-image">
          <img src="./assets/img/user.jpg" alt="User Avatar" />
        </div>

        <!-- View Mode -->
        <div class="profile-info view-mode">
          <p><strong>Name:</strong> <span id="view-name">John Doe</span></p>
          <p>
            <strong>Email:</strong>
            <span id="view-email">john@example.com</span>
          </p>
          <p>
            <strong>Phone:</strong>
            <span id="view-phone">+880 123456789</span>
          </p>
          <p><strong>Joined:</strong> March 15, 2023</p>
        </div>

        <!-- Edit Mode -->
        <form class="profile-edit-form edit-mode" style="display: none">
          <div class="form-group">
            <label for="edit-name">Name:</label>
            <input type="text" id="edit-name" value="John Doe" />
          </div>
          <div class="form-group">
            <label for="edit-email">Email:</label>
            <input type="email" id="edit-email" value="john@example.com" />
          </div>
          <div class="form-group">
            <label for="edit-phone">Phone:</label>
            <input type="text" id="edit-phone" value="+880 123456789" />
          </div>
          <div class="form-group">
            <label for="edit-avatar">Profile Picture:</label>
            <input type="file" id="edit-avatar" />
          </div>
        </form>
      </div>

      <!-- Toggle Button -->
      <div class="edit-profile-btn">
        <button class="btn-primary" id="toggleEditBtn">
          <i class="fas fa-edit"></i> Edit Profile
        </button>
      </div>
    </section>
  </main>

  <!-- FOOTER -->
  <?php include('./../assets/components/footer.php'); ?>

  <script>
    const toggleBtn = document.getElementById("toggleEditBtn");
    const viewMode = document.querySelector(".view-mode");
    const editMode = document.querySelector(".edit-mode");

    let isEditing = false;

    toggleBtn.addEventListener("click", () => {
      isEditing = !isEditing;

      if (isEditing) {
        viewMode.style.display = "none";
        editMode.style.display = "block";
        toggleBtn.innerHTML = '<i class="fas fa-save"></i> Save Changes';
      } else {
        // OPTIONAL: You can sync edited data back to view mode here
        document.getElementById("view-name").innerText =
          document.getElementById("edit-name").value;
        document.getElementById("view-email").innerText =
          document.getElementById("edit-email").value;
        document.getElementById("view-phone").innerText =
          document.getElementById("edit-phone").value;

        viewMode.style.display = "block";
        editMode.style.display = "none";
        toggleBtn.innerHTML = '<i class="fas fa-edit"></i> Edit Profile';
      }
    });
  </script>
</body>

</html>