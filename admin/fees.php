<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
  header("Location: http://localhost/edu/admin/login.php");
  exit;
}

// Connect to the database
$conn = new mysqli("localhost", "root", "", "edumarkethub");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Handle Approve/Reject actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['approve_payment_id'])) {
    $paymentId = $_POST['approve_payment_id'];

    $stmt = $conn->prepare("UPDATE registration_fees SET status = 'approved' WHERE id = ?");
    $stmt->bind_param("s", $paymentId);
    $stmt->execute();

    header("Location: ./fees.php");
    exit;

  } elseif (isset($_POST['reject_payment_id'])) {
    $paymentId = $_POST['reject_payment_id'];

    $stmt = $conn->prepare("UPDATE registration_fees SET status = 'rejected' WHERE id = ?");
    $stmt->bind_param("s", $paymentId);
    $stmt->execute();

    header("Location: ./fees.php");
    exit;
  }
}
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
  <link rel="stylesheet" href="./assets/css/fees.css" />
</head>

<body>
  <!-- HEADER -->
  <?php include('./assets/components/admin-nav.php'); ?>

  <!-- MAIN CONTENT -->
  <main class="container">
    <section class="admin-payments-section">
      <h2 class="section-title">All Payments</h2>

      <div class="table-wrapper">
        <table class="payment-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Date</th>
              <th>User</th>
              <th>User ID</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = "
  SELECT 
    registration_fees.id,
    registration_fees.created_at,
    registration_fees.status,
    users.name AS user_name,
    users.id AS user_id
  FROM registration_fees
  JOIN users ON registration_fees.user_id = users.id
  ORDER BY registration_fees.created_at DESC
";

            $result = $conn->query($query);

            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                $statusClass = strtolower($row['status']);
                echo "<tr>
      <td>#{$row['id']}</td>
      <td>{$row['created_at']}</td>
      <td>{$row['user_name']}</td>
      <td>#{$row['user_id']}</td>
      <td><span class='status {$statusClass}'>" . ucfirst($row['status']) . "</span></td>
      <td class='action-buttons'>
        <form method='post' style='display:inline-block;'>
          <input type='hidden' name='approve_payment_id' value='{$row['id']}'>
          <button type='submit' class='btn approve'>Approve</button>
        </form>
        <form method='post' style='display:inline-block; margin-left: 5px;'>
          <input type='hidden' name='reject_payment_id' value='{$row['id']}'>
          <button type='submit' class='btn reject'>Reject</button>
        </form>
      </td>
    </tr>";
              }
            } else {
              echo "<tr><td colspan='9'>No payment records found.</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </section>
  </main>

  <!-- FOOTER -->
  <?php include('./../assets/components/footer.php'); ?>
</body>

</html>