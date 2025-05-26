<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EduMarketHub - Admin</title>

  <!-- Font Awesome -->
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
    rel="stylesheet" />

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
          <p>1,250</p>
        </div>
      </article>

      <article class="card">
        <div class="card-icon"><i class="fas fa-book"></i></div>
        <div class="card-info">
          <h3>Total Courses</h3>
          <p>87</p>
        </div>
      </article>

      <article class="card">
        <div class="card-icon"><i class="fas fa-dollar-sign"></i></div>
        <div class="card-info">
          <h3>Total Payments</h3>
          <p>$45,000</p>
        </div>
      </article>

      <article class="card">
        <div class="card-icon"><i class="fas fa-chart-line"></i></div>
        <div class="card-info">
          <h3>Active Users</h3>
          <p>980</p>
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
          <tr>
            <td>Michael Scott</td>
            <td>michael@dundermifflin.com</td>
            <td>2025-05-10</td>
            <td><span class="status active">Active</span></td>
          </tr>
          <tr>
            <td>Pam Beesly</td>
            <td>pam@dundermifflin.com</td>
            <td>2025-05-09</td>
            <td><span class="status inactive">Inactive</span></td>
          </tr>
          <tr>
            <td>Jim Halpert</td>
            <td>jim@dundermifflin.com</td>
            <td>2025-05-08</td>
            <td><span class="status active">Active</span></td>
          </tr>
        </tbody>
      </table>
    </section>
  </main>

  <!-- FOOTER -->
  <?php include('./../assets/components/footer.php'); ?>
</body>

</html>