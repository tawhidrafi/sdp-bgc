<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
  header("Location: http://localhost/edu/admin/login.php");
  exit;
}

$conn = new mysqli("localhost", "root", "", "edumarkethub");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Summary: Total users, active users, total courses, total approved payments
$summaryQuery = "
  SELECT
    (SELECT COUNT(*) FROM users) AS total_users,
    (SELECT COUNT(*) FROM users WHERE status = 'active') AS active_users,
    (SELECT COUNT(*) FROM courses) AS total_courses,
    (SELECT IFNULL(SUM(cr.price), 0) 
      FROM payments p 
      INNER JOIN courses cr ON cr.id = p.course_id 
      WHERE p.status = 'approved') AS total_payments
";
$summaryResult = mysqli_query($conn, $summaryQuery);
$summary = mysqli_fetch_assoc($summaryResult);

// Recent users
$recentUsersQuery = "SELECT name, email, registered_at, status FROM users ORDER BY registered_at DESC LIMIT 5";
$recentUsersResult = mysqli_query($conn, $recentUsersQuery);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EduMarketHub - Admin</title>

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />

  <!-- Stylesheets -->
  <link rel="stylesheet" href="./assets/css/global.css" />
  <link rel="stylesheet" href="./assets/css/dashboard.css" />
</head>

<body>
  <!-- HEADER -->
  <?php include('./assets/components/admin-nav.php'); ?>

  <!-- MAIN CONTENT -->
  <main class="dashboard-main container">
    <h2 class="section-title">Admin Dashboard</h2>

    <!-- Summary Cards -->
    <section class="summary-cards">
      <article class="card">
        <div class="card-icon"><i class="fas fa-users"></i></div>
        <div class="card-info">
          <h3>Total Users</h3>
          <p><?= $summary['total_users'] ?></p>
        </div>
      </article>

      <article class="card">
        <div class="card-icon"><i class="fas fa-book"></i></div>
        <div class="card-info">
          <h3>Total Courses</h3>
          <p><?= $summary['total_courses'] ?></p>
        </div>
      </article>

      <article class="card">
        <div class="card-icon"><i class="fas fa-dollar-sign"></i></div>
        <div class="card-info">
          <h3>Total Payments</h3>
          <p>$<?= number_format($summary['total_payments'], 2) ?></p>
        </div>
      </article>

      <article class="card">
        <div class="card-icon"><i class="fas fa-chart-line"></i></div>
        <div class="card-info">
          <h3>Active Users</h3>
          <p><?= $summary['active_users'] ?></p>
        </div>
      </article>
    </section>


    <!-- Recent Users Table -->
    <section class="recent-users">
      <h3>Recent User Signups</h3>
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Registration Date</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($user = mysqli_fetch_assoc($recentUsersResult)): ?>
            <tr>
              <td><?= htmlspecialchars($user['name']) ?></td>
              <td><?= htmlspecialchars($user['email']) ?></td>
              <td><?= date('Y-m-d', strtotime($user['registered_at'])) ?></td>
              <td>
                <span class="status <?= $user['status'] == 'active' ? 'active' : 'inactive' ?>">
                  <?= ucfirst($user['status']) ?>
                </span>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </section>

  </main>

  <!-- FOOTER -->
  <?php include('./../assets/components/footer.php'); ?>
</body>

</html>