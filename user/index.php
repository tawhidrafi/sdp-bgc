<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: ../login.php");
  exit();
}

$conn = new mysqli("localhost", "root", "", "edumarkethub");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

// Fetch user registration date
$user_stmt = $conn->prepare("SELECT registered_at FROM users WHERE id = ?");
$user_stmt->bind_param("i", $user_id);
$user_stmt->execute();
$user = $user_stmt->get_result()->fetch_assoc();
$member_since = date("d M Y", strtotime($user['registered_at']));

// Total courses bought (from payments table)
$bought_stmt = $conn->prepare("SELECT COUNT(*) AS total, SUM(c.price) AS total_spent
    FROM payments p
    JOIN courses c ON p.course_id = c.id
    WHERE p.user_id = ? AND p.status = 'approved'");
$bought_stmt->bind_param("i", $user_id);
$bought_stmt->execute();
$bought_data = $bought_stmt->get_result()->fetch_assoc();
$courses_bought = $bought_data['total'] ?? 0;
$total_expenses = $bought_data['total_spent'] ?? 0;

// Total courses sold (courses owned by user and approved payments exist)
$sold_stmt = $conn->prepare("SELECT COUNT(*) AS total_sales, SUM(c.price) AS earnings
    FROM payments p
    JOIN courses c ON p.course_id = c.id
    WHERE c.user_id = ? AND p.status = 'approved'");
$sold_stmt->bind_param("i", $user_id);
$sold_stmt->execute();
$sold_data = $sold_stmt->get_result()->fetch_assoc();
$courses_sold = $sold_data['total_sales'] ?? 0;
$total_earnings = $sold_data['earnings'] ?? 0;

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
  <link rel="stylesheet" href="./assets/css/home.css" />
</head>

<body>
  <!-- HEADER -->
  <?php include('./assets/components/user-nav.php'); ?>

  <!-- MAIN CONTENT -->
  <main class="container">
    <section class="dashboard-overview">
      <!-- STAT CARDS -->
      <div class="stats-grid">
        <div class="stat-card">
          <h3>Member Since</h3>
          <p><strong><?php echo $member_since; ?></strong></p>
        </div>
        <div class="stat-card">
          <h3>Courses Bought</h3>
          <p><strong><?php echo $courses_bought; ?></strong></p>
        </div>
        <div class="stat-card">
          <h3>Courses Sold</h3>
          <p><strong><?php echo $courses_sold; ?></strong></p>
        </div>
        <div class="stat-card">
          <h3>Total Earnings</h3>
          <p><strong>$<?php echo number_format($total_earnings, 2); ?></strong></p>
        </div>
        <div class="stat-card">
          <h3>Total Expenses</h3>
          <p><strong>$<?php echo number_format($total_expenses, 2); ?></strong></p>
        </div>
      </div>



      <!-- PENDING PAYMENTS -->
      <!-- <section class="dashboard-section pending-payments">
        <h2>Pending Payments / Approvals</h2>
        <ul class="pending-list">
          <li>
            <strong>Purchase:</strong> "Advanced SQL Note" — Waiting for
            Approval
          </li>
          <li>
            <strong>Upload:</strong> "Data Structures in Go" — Under Review
          </li>
        </ul>
      </section> -->

      <!-- QUICK SHORTCUTS -->
      <section class="dashboard-section dashboard-shortcuts">
        <h2>Quick Shortcuts</h2>
        <div class="shortcut-grid">
          <a href="./upload-course.php" class="shortcut-btn">
            <i class="fas fa-upload"></i> Upload Course
          </a>
          <a href="./enrolled.php" class="shortcut-btn">
            <i class="fas fa-book"></i> My Courses
          </a>
          <a href="./profile.php" class="shortcut-btn">
            <i class="fas fa-user"></i> Edit Profile
          </a>
          <a href="../contact.php" class="shortcut-btn">
            <i class="fas fa-headset"></i> Contact Admin
          </a>

        </div>
      </section>
    </section>
  </main>

  <!-- FOOTER -->
  <?php include('./../assets/components/footer.php'); ?>
</body>

</html>