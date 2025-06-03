<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: ../login.php");
  exit;
}

$conn = new mysqli("localhost", "root", "", "edumarkethub");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

// Check if the user's registration fee is approved
$query = "SELECT * FROM registration_fees WHERE user_id = ? AND status = 'approved'";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$feeApproved = ($result->num_rows > 0); // Boolean flag for approval status

$stmt->close();

if (!$feeApproved) {
  header("Location: ./pay-reg-fee.php");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $name = trim($_POST['name']);
  $category = trim($_POST['category']);
  $type = $_POST['type'];
  $duration = trim($_POST['duration']);
  $level = trim($_POST['level']);
  $lectures = intval($_POST['lectures']);
  $language = trim($_POST['language']);
  $price = floatval($_POST['price']);
  $details = trim($_POST['details']);
  $user_id = $_SESSION['user_id'];

  $image = $_FILES['image'];
  $courseFile = $_FILES['file'];

  $uploadDirImg = '../courses/assets/img/';
  $uploadDirFile = '../courses/assets/file/';

  $imageName = time() . '_' . basename($image['name']);
  $courseFileName = time() . '_' . basename($courseFile['name']);

  $imagePath = $uploadDirImg . $imageName;
  $coursePath = $uploadDirFile . $courseFileName;

  $errors = [];

  $ext = pathinfo($courseFileName, PATHINFO_EXTENSION);
  if (strtolower($ext) !== 'zip') {
    $errors[] = "Course file must be a .zip archive.";
  }

  if (empty($errors)) {
    if (
      move_uploaded_file($image['tmp_name'], $imagePath) &&
      move_uploaded_file($courseFile['tmp_name'], $coursePath)
    ) {
      $stmt = $conn->prepare("INSERT INTO courses (user_id, name, category, cover_image, type, duration, level, lectures, language, price, details, course_file)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("issssssissss", $user_id, $name, $category, $imageName, $type, $duration, $level, $lectures, $language, $price, $details, $courseFileName);

      if ($stmt->execute()) {
        $success = "Course uploaded successfully!";
        header("Refresh: 2; URL = index.php"); // Redirect after 2 seconds
      } else {
        $errors[] = "Database error: " . $stmt->error;
      }

      $stmt->close();
    } else {
      $errors[] = "Failed to upload files.";
    }
  }

  $conn->close();
}
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
  <link rel="stylesheet" href="./assets/css/upload-course.css" />
</head>

<body>
  <!-- HEADER -->
  <?php include('./assets/components/user-nav.php'); ?>

  <!-- MAIN CONTENT -->
  <main class="container">
    <section class="upload-course-section">
      <h2 class="section-title">Upload New Course / Note</h2>

      <form class="upload-form" enctype="multipart/form-data" action="" method="post">

        <?php if (!empty($success)): ?>
          <div class="alert success"><?php echo $success; ?></div>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
          <div class="alert error">
            <ul>
              <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars($error); ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>

        <div class="form-grid">
          <!-- Left Column -->
          <div class="form-group">
            <label for="name">Course Name</label>
            <input type="text" id="name" name="name" required />
          </div>

          <div class="form-group">
            <label for="category">Category</label>
            <input type="text" id="category" name="category" required />
          </div>

          <div class="form-group">
            <label for="image">Cover Image</label>
            <input type="file" id="image" name="image" accept="image/*" required />
          </div>

          <div class="form-group">
            <label for="type">Type</label>
            <select id="type" name="type" required>
              <option value="">Select Type</option>
              <option value="course">Course</option>
              <option value="note">Note</option>
            </select>
          </div>

          <div class="form-group">
            <label for="duration">Duration (e.g. 2h 30m)</label>
            <input type="text" id="duration" name="duration" required />
          </div>

          <div class="form-group">
            <label for="level">Skill Level</label>
            <input type="text" id="level" name="level" placeholder="Beginner / Intermediate / Expert" required />
          </div>

          <!-- Right Column -->
          <div class="form-group">
            <label for="lectures">No. of Lectures</label>
            <input type="number" id="lectures" name="lectures" required />
          </div>

          <div class="form-group">
            <label for="language">Language</label>
            <input type="text" id="language" name="language" required />
          </div>

          <div class="form-group">
            <label for="price">Price (in $)</label>
            <input type="number" id="price" name="price" min="0" required />
          </div>

          <div class="form-group">
            <label for="file">Course File (.zip only)</label>
            <input type="file" id="file" name="file" accept=".zip" required />
          </div>

          <!-- Full-width Details Field -->
          <div class="form-group full-width">
            <label for="details">Details</label>
            <textarea id="details" name="details" rows="4" required></textarea>
          </div>
        </div>

        <button type="submit" class="btn submit-btn">Upload Course</button>
      </form>
    </section>
  </main>

  <!-- FOOTER -->
  <?php include('./../assets/components/footer.php'); ?>
</body>

</html>