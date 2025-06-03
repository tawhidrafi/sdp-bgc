<?php
session_start();

$conn = new mysqli("localhost", "root", "", "edumarkethub");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['user_id'])) {
  header("Location: ../login.php");
  exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM courses WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EduMarketHub - My Courses</title>

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />

  <!-- Stylesheets -->
  <link rel="stylesheet" href="./assets/css/global.css" />
  <link rel="stylesheet" href="./assets/css/courses.css" />
</head>

<body>
  <!-- HEADER -->
  <?php include('./assets/components/user-nav.php'); ?>

  <!-- MAIN CONTENT -->
  <main class="container">
    <section class="courses-section my-courses">
      <div class="courses-container">
        <div class="courses-header">
          <h6 class="courses-subtitle">My Library</h6>
          <h1 class="courses-title">Uploaded Courses</h1>
        </div>

        <div class="courses-grid">
          <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
              <div class="course-item">
                <a href="../courses/detail.php?id=<?= $row['id'] ?>">
                  <img src="../courses/assets/img/<?= htmlspecialchars($row['cover_image']) ?>"
                    alt="<?= htmlspecialchars($row['name']) ?>" class="course-image" />
                  <div class="course-content">
                    <h5 class="course-title"><?= htmlspecialchars($row['name']) ?></h5>
                    <div class="course-footer">
                      <span class="course-author">You</span>
                      <span class="course-progress"><?= ucfirst($row['level']) ?> •
                        <?= htmlspecialchars($row['language']) ?></span>
                    </div>
                  </div>
                </a>
              </div>
            <?php endwhile; ?>
          <?php else: ?>
            <p style="margin-top: 20px;">You haven't uploaded any courses yet.</p>
          <?php endif; ?>
        </div>
      </div>
    </section>
  </main>

  <!-- FOOTER -->
  <?php include('./../assets/components/footer.php'); ?>
</body>

</html>