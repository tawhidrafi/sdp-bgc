<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header('Location: ../login.php');
  exit();
}

$conn = new mysqli("localhost", "root", "", "edumarkethub");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT name, email, registered_at, profile_image FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_profile'])) {
  $name = $_POST['edit-name'];
  $email = $_POST['edit-email'];

  $imageFileName = null;
  $targetDir = "./assets/img/";

  if (isset($_FILES['edit-avatar']) && $_FILES['edit-avatar']['error'] === UPLOAD_ERR_OK) {
    $imageTmp = $_FILES['edit-avatar']['tmp_name'];
    $originalName = basename($_FILES['edit-avatar']['name']);
    $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

    // Validate image extension
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    if (in_array($extension, $allowedTypes)) {
      $imageFileName = "user_" . $user_id . "_" . time() . "." . $extension;
      move_uploaded_file($imageTmp, $targetDir . $imageFileName);
    }
  }

  // If a new image is uploaded, update profile_image too
  if ($imageFileName) {
    $update_sql = "UPDATE users SET name = ?, email = ?, profile_image = ? WHERE id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("sssi", $name, $email, $imageFileName, $user_id);
  } else {
    $update_sql = "UPDATE users SET name = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("ssi", $name, $email, $user_id);
  }

  if ($stmt->execute()) {
    header("Location: profile.php");
    exit();
  } else {
    echo "<p style='color: red;'>Failed to update profile. Please try again.</p>";
  }
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EduMarketHub - User</title>

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />

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
          <img
            src="<?= !empty($user['profile_image']) ? './assets/img/' . htmlspecialchars($user['profile_image']) : './assets/img/default.jpg' ?>"
            alt="User Avatar" />
        </div>

        <!-- View Mode -->
        <div class="profile-info view-mode">
          <p><strong>Name:</strong> <span id="view-name"><?= htmlspecialchars($user['name']) ?></span></p>
          <p><strong>Email:</strong> <span id="view-email"><?= htmlspecialchars($user['email']) ?></span></p>
          <p><strong>Joined:</strong> <?= date("F j, Y", strtotime($user['registered_at'])) ?></p>
        </div>

        <!-- Edit Mode -->
        <form class="profile-edit-form edit-mode" style="display: none" action="" method="POST"
          enctype="multipart/form-data">
          <div class="form-group">
            <label for="edit-name">Name:</label>
            <input type="text" id="edit-name" value="<?= htmlspecialchars($user['name']) ?>" name="edit-name" />
          </div>
          <div class="form-group">
            <label for="edit-email">Email:</label>
            <input type="email" id="edit-email" value="<?= htmlspecialchars($user['email']) ?>" name="edit-email" />
          </div>
          <div class="form-group">
            <label for="edit-avatar">Profile Picture:</label>
            <input type="file" id="edit-avatar" name="edit-avatar" />
          </div>
          <input type="submit" name="save_profile" value="Save" />
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
    const form = document.querySelector(".profile-edit-form");

    let isEditing = false;

    toggleBtn.addEventListener("click", () => {
      isEditing = !isEditing;

      if (isEditing) {
        viewMode.style.display = "none";
        editMode.style.display = "block";
        toggleBtn.style.display = 'none';
      }
    });
  </script>

</body>

</html>