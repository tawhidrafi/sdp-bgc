<?php

session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: ../login.php");
  exit();
}

$conn = new mysqli("localhost", "root", "", "edumarkethub");

// Get all courses owned by this user
$owner_id = $_SESSION['user_id'];
$courses = [];
$result = $conn->query("SELECT id, name FROM courses WHERE user_id = $owner_id");
if ($result) {
  while ($row = $result->fetch_assoc()) {
    $courses[$row['id']] = $row['name'];
  }
}

$payments = [];
if (!empty($courses)) {
  $course_ids = implode(",", array_keys($courses));
  $sql = "SELECT p.*, u.name as buyer_name 
            FROM payments p
            JOIN users u ON p.user_id = u.id
            WHERE p.course_id IN ($course_ids) AND p.status = 'pending'";
  $result = $conn->query($sql);
  if ($result) {
    while ($row = $result->fetch_assoc()) {
      $payments[] = $row;
    }
  }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
  $payment_id = intval($_POST['payment_id']);
  $action = $_POST['action']; // 'approve' or 'reject'

  // Verify this payment belongs to owner's course
  $valid = false;
  foreach ($payments as $p) {
    if ($p['id'] == $payment_id) {
      $valid = true;
      break;
    }
  }

  if ($valid) {
    $new_status = $action === 'approve' ? 'approved' : 'rejected';
    $stmt = $conn->prepare("UPDATE payments SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $new_status, $payment_id);
    $stmt->execute();
    $stmt->close();

    // Refresh payments list
    header("Location: ./manage-payments.php");
    exit();
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
  <link rel="stylesheet" href="./assets/css/manage-payments.css" />
</head>

<body>
  <!-- HEADER -->
  <?php include('./assets/components/user-nav.php'); ?>

  <!-- MAIN CONTENT -->
  <main class="container">
    <section class="admin-payments-section">
      <h2 class="section-title">Manage Course Payments</h2>

      <div class="table-wrapper">
        <?php if (empty($courses)): ?>
          <div class="empty-state">
            <p>You don't have any courses yet.</p>
          </div>
        <?php elseif (empty($payments)): ?>
          <div class="empty-state">
            <p>No pending payments for your courses.</p>
          </div>
        <?php else: ?>
          <table class="payment-table">
            <thead>
              <tr>
                <th>Course</th>
                <th>Buyer</th>
                <th>Phone</th>
                <th>Transaction ID</th>
                <th>Date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($payments as $payment): ?>
                <tr>
                  <td><?= htmlspecialchars($courses[$payment['course_id']]) ?></td>
                  <td><?= htmlspecialchars($payment['buyer_name']) ?></td>
                  <td><?= htmlspecialchars($payment['phone']) ?></td>
                  <td><?= htmlspecialchars($payment['trxid']) ?></td>
                  <td><?= htmlspecialchars($payment['created_at']) ?></td>
                  <td class="action-buttons">
                    <form method="POST" style="display:inline;">
                      <input type="hidden" name="payment_id" value="<?= $payment['id'] ?>">
                      <button type="submit" name="action" value="approve" class="btn approve">Approve</button>
                      <button type="submit" name="action" value="reject" class="btn reject">Reject</button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </section>
    <?php endif; ?>
  </main>

  <!-- FOOTER -->
  <?php include('./../assets/components/footer.php'); ?>
</body>

</html>