<?php
$conn = new mysqli("localhost", "root", "", "edumarkethub");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "
  SELECT courses.*, users.name AS author_name
  FROM courses
  JOIN users ON courses.user_id = users.id
  ORDER BY courses.created_at DESC
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EduMarketHub - All Courses</title>

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="./assets/css/global.css" />
  <link rel="stylesheet" href="./assets/css/courses.css" />
</head>

<body>
  <!-- header -->
  <header class="navbar">
    <div class="logo">
      <h1><i class="fa fa-book-reader"></i> EduMarketHub</h1>
    </div>
    <nav class="nav-links">
      <a href="../index.php">Home</a>
      <a href="../about.php">About</a>
      <a href="../courses/index.php">Courses</a>
      <a href="../contact.php">Contact</a>
    </nav>
    <a href="../register.php" class="join-btn">Join Us</a>
  </header>

  <!-- Courses Start -->
  <main class="container">
    <section class="courses-section my-courses">
      <div class="courses-container">
        <div class="courses-header">
          <h6 class="courses-subtitle">Our courses</h6>
          <h1 class="courses-title">Available Courses</h1>
        </div>

        <div class="courses-grid">
          <?php if ($result->num_rows > 0): ?>
            <?php while ($course = $result->fetch_assoc()): ?>
              <div class="course-item">
                <a href="./detail.php?id=<?= $course['id'] ?>">
                  <img src="./assets/img/<?= htmlspecialchars($course['cover_image']) ?>"
                    alt="<?= htmlspecialchars($course['name']) ?>" class="course-image" />
                  <div class="course-content">
                    <h5 class="course-title"><?= htmlspecialchars($course['name']) ?></h5>
                    <div class="course-footer">
                      <span class="course-author"><?= htmlspecialchars($course['author_name']) ?></span>
                      <span class="course-price">৳<?= number_format($course['price'], 2) ?></span>
                    </div>
                  </div>
                </a>
              </div>
            <?php endwhile; ?>
          <?php else: ?>
            <p>No courses found.</p>
          <?php endif; ?>
        </div>
      </div>
    </section>
  </main>

  <!-- footer -->
  <?php include('../assets/components/footer.php'); ?>

</body>

</html>

<?php $conn->close(); ?>