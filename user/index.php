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
          <p><strong>15 Mar 2023</strong></p>
        </div>
        <div class="stat-card">
          <h3>Courses Bought</h3>
          <p><strong>8</strong></p>
        </div>
        <div class="stat-card">
          <h3>Courses Sold</h3>
          <p><strong>5</strong></p>
        </div>
        <div class="stat-card">
          <h3>Total Earnings</h3>
          <p><strong>$450</strong></p>
        </div>
        <div class="stat-card">
          <h3>Total Expenses</h3>
          <p><strong>$320</strong></p>
        </div>
      </div>

      <!-- PENDING PAYMENTS -->
      <section class="dashboard-section pending-payments">
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
      </section>

      <!-- QUICK SHORTCUTS -->
      <section class="dashboard-section dashboard-shortcuts">
        <h2>Quick Shortcuts</h2>
        <div class="shortcut-grid">
          <a href="./upload-course.html" class="shortcut-btn">
            <i class="fas fa-upload"></i> Upload Course
          </a>
          <a href="./enrolled.html" class="shortcut-btn">
            <i class="fas fa-book"></i> My Courses
          </a>
          <a href="./earnings.html" class="shortcut-btn">
            <i class="fas fa-dollar-sign"></i> Check Earnings
          </a>
          <a href="./profile.html" class="shortcut-btn">
            <i class="fas fa-user"></i> Edit Profile
          </a>
          <a href="./../contact.html" class="shortcut-btn">
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