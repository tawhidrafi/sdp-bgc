<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "edumarkethub");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT 
  u.id AS user_id,
  u.name,
  u.email,
  u.registered_at,
  u.status,
  COUNT(DISTINCT CASE WHEN p.status = 'approved' THEN p.course_id END) AS enrolled,
  COUNT(DISTINCT c.id) AS uploaded,
  IFNULL(SUM(p_amount.amount_paid), 0) AS paid,
  IFNULL(SUM(p_amount.amount_earned), 0) AS earned
FROM users u
LEFT JOIN courses c ON c.user_id = u.id
LEFT JOIN payments p ON p.user_id = u.id
LEFT JOIN (
    SELECT 
        p.id AS payment_id,
        p.user_id,
        p.course_id,
        cr.price AS amount_paid,
        cr.price AS amount_earned
    FROM payments p
    INNER JOIN courses cr ON cr.id = p.course_id
    WHERE p.status = 'approved'
) p_amount ON p_amount.payment_id = p.id
GROUP BY u.id
ORDER BY u.registered_at DESC;
";


$result = mysqli_query($conn, $sql);
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
  <link rel="stylesheet" href="./assets/css/users.css" />
</head>

<body>
  <!-- HEADER -->
  <?php include('./assets/components/admin-nav.php'); ?>

  <!-- MAIN CONTENT -->
  <main class="container">
    <section class="admin-users-section">
      <h2 class="section-title">All Registered Users</h2>

      <div class="table-wrapper">
        <table class="user-table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Registered</th>
              <th>Enrolled</th>
              <th>Uploaded</th>
              <th>Paid ($)</th>
              <th>Earned ($)</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
              <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= $row['registered_at'] ?></td>
                <td><?= $row['enrolled'] ?></td>
                <td><?= $row['uploaded'] ?></td>
                <td><?= $row['paid'] ?></td>
                <td><?= $row['earned'] ?></td>
              </tr>
            <?php endwhile; ?>
          </tbody>

        </table>
      </div>
    </section>
  </main>

  <!-- FOOTER -->
  <?php include('./../assets/components/footer.php'); ?>
</body>

</html>