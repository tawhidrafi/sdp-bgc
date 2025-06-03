<?php
session_start();

$isLoggedIn = isset($_SESSION['user_id']);
$userId = $isLoggedIn ? $_SESSION['user_id'] : 0;

$conn = new mysqli("localhost", "root", "", "edumarkethub");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$course_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$course = null;

if ($course_id > 0) {
  $sql = "SELECT courses.*, users.name AS creator_name 
          FROM courses 
          JOIN users ON courses.user_id = users.id 
          WHERE courses.id = $course_id LIMIT 1";
  $result = $conn->query($sql);
  if ($result && $result->num_rows > 0) {
    $course = $result->fetch_assoc();
  }
}

$isOwner = $isLoggedIn && $course && $userId == $course['user_id'];
$totalSales = 0;
$totalRevenue = 0;

if ($course) {
  $salesSql = "SELECT COUNT(*) AS total_sales FROM payments 
               WHERE course_id = $course_id AND status = 'approved'";
  $salesResult = $conn->query($salesSql);
  if ($salesResult && $salesResult->num_rows > 0) {
    $salesData = $salesResult->fetch_assoc();
    $totalSales = intval($salesData['total_sales']);
    $totalRevenue = $totalSales * floatval($course['price']);
  }
}

$hasAccess = false;
$hasPendingPayment = false;

if ($isLoggedIn && !$isOwner && $course) {
  $approvedSql = "SELECT * FROM payments 
                  WHERE user_id = $userId AND course_id = $course_id AND status = 'approved' LIMIT 1";
  $approvedResult = $conn->query($approvedSql);
  if ($approvedResult && $approvedResult->num_rows > 0) {
    $hasAccess = true;
  } else {
    $pendingSql = "SELECT * FROM payments 
                   WHERE user_id = $userId AND course_id = $course_id AND status = 'pending' LIMIT 1";
    $pendingResult = $conn->query($pendingSql);
    if ($pendingResult && $pendingResult->num_rows > 0) {
      $hasPendingPayment = true;
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EduMarketHub - Course Details</title>

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="./assets/css/global.css" />
  <link rel="stylesheet" href="./assets/css/detail.css" />
</head>

<body>

  <header class="navbar">
    <div class="logo">
      <h1><i class="fa fa-book-reader"></i> EduMarketHub</h1>
    </div>
    <nav class="nav-links">
      <a href="../index.php">Home</a>
      <a href="../about.php">About</a>
      <a href="./index.php">Courses</a>
      <a href="../contact.php">Contact</a>
    </nav>
  </header>

  <main class="container">
    <section class="course-detail-section">
      <div class="course-detail-container">
        <div class="course-detail-row">
          <article class="course-content">
            <header class="course-header">
              <h6 class="course-subtitle">Course Detail</h6>
              <h1 class="course-title">
                <?= $course ? htmlspecialchars($course['name']) : 'Course Not Found' ?>
              </h1>
            </header>

            <figure class="course-image-wrapper">
              <img
                src="<?= $course && $course['cover_image'] ? './assets/img/' . htmlspecialchars($course['cover_image']) : './assets/img/default.jpg' ?>"
                alt="Course Header" class="course-image" />
            </figure>

            <p class="course-description">
              <?= $course ? nl2br(htmlspecialchars($course['details'])) : 'No course description available.' ?>
            </p>

            <?php if (!$course): ?>
              <p class="course-description" style="color: red;">
                Invalid course or course not found.
              </p>
            <?php endif; ?>

            <!-- OWNER SECTION -->
            <?php if ($isOwner): ?>
              <div class="owner-section">
                <h3 class="section-heading">Your Uploaded Course</h3>
                <div class="owner-stats">
                  <p><strong>Total Copies Sold:</strong> <?= $totalSales ?></p>
                  <p><strong>Total Revenue Generated:</strong> $<?= number_format($totalRevenue, 2) ?></p>
                </div>
              </div>

              <!-- APPROVED BUYER -->
            <?php elseif ($hasAccess): ?>
              <div class="buyer-section">
                <h3 class="section-heading">📥 Download Your Files</h3>
                <a href="../courses/assets/<?= htmlspecialchars($course['course_file']) ?>" download
                  class="download-button">Download Course Files (.zip)</a>
              </div>

              <!-- PENDING PAYMENT -->
              <!-- Change this section in detail.php -->
            <?php elseif ($hasPendingPayment): ?>
              <div class="pending-section">
                <h3 class="section-heading">⏳ Payment Pending</h3>
                <p>Your payment is waiting for approval from the course owner.</p>
              </div>

              <!-- GUEST USER -->
            <?php elseif (!$isLoggedIn): ?>
              <div class="guest-section">
                <h3 class="section-heading">🎓 Ready to Learn?</h3>
                <p>
                  This course includes lifetime access to downloadable files,
                  community feedback, and updates.
                </p>
                <a href="login.php" class="enroll-button enroll-now">Log In to Buy</a>
              </div>

              <!-- LOGGED-IN USER BUT NO PAYMENT -->
            <?php elseif ($isLoggedIn && !$isOwner): ?>
              <div class="purchase-section">
                <h3 class="section-heading">🛒 Buy This Course</h3>
                <p>This course costs $<?= htmlspecialchars($course['price']) ?>. After payment and admin approval, you’ll
                  be able to download it.</p>
                <a href="../user/payment.php?course_id=<?= $course_id ?>" class="enroll-button enroll-now">Proceed to
                  Payment</a>
              </div>
            <?php endif; ?>
          </article>

          <aside class="course-sidebar">
            <section class="course-features">
              <h3 class="features-title">Course Features</h3>

              <dl class="feature-list">
                <div class="feature-item">
                  <dt class="feature-label">Creator</dt>
                  <dd class="feature-value"><?= $course ? htmlspecialchars($course['creator_name']) : 'N/A' ?></dd>
                </div>
                <div class="feature-item">
                  <dt class="feature-label">Lectures</dt>
                  <dd class="feature-value"><?= $course ? htmlspecialchars($course['lectures']) : 'N/A' ?></dd>
                </div>
                <div class="feature-item">
                  <dt class="feature-label">Duration</dt>
                  <dd class="feature-value"><?= $course ? htmlspecialchars($course['duration']) : 'N/A' ?></dd>
                </div>
                <div class="feature-item">
                  <dt class="feature-label">Skill Level</dt>
                  <dd class="feature-value"><?= $course ? htmlspecialchars($course['level']) : 'N/A' ?></dd>
                </div>
                <div class="feature-item">
                  <dt class="feature-label">Language</dt>
                  <dd class="feature-value"><?= $course ? htmlspecialchars($course['language']) : 'N/A' ?></dd>
                </div>
              </dl>

              <div class="course-price">
                Course Price: $<?= $course ? htmlspecialchars($course['price']) : '0.00' ?>
              </div>
            </section>
          </aside>
        </div>
      </div>
    </section>
  </main>

  <?php include('../assets/components/footer.php'); ?>
</body>

</html>