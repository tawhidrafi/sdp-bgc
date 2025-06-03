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

$isLoggedIn = isset($_SESSION['user_id']);
$user_id = $isLoggedIn ? $_SESSION['user_id'] : 0;

// Check if the user's registration fee is approved
$query = "SELECT * FROM registration_fees WHERE user_id = ? AND status = 'approved'";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$feeApproved = ($result->num_rows > 0); // Boolean flag for approval status

$stmt->close();

if (!$feeApproved) {
  header("Location: ./pay-reg-fee.php");
  exit();
}

$course_id = isset($_GET['course_id']) ? intval($_GET['course_id']) : 0;
$course = null;
if ($course_id > 0) {
  $result = $conn->query("SELECT c.*, u.bkash_num 
                            FROM courses c 
                            JOIN users u ON c.user_id = u.id 
                            WHERE c.id = $course_id LIMIT 1");
  if ($result && $result->num_rows > 0) {
    $course = $result->fetch_assoc();
  }
}

// Handle form submission only if registration fee is approved
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $phone = $_POST['phone'];
  $trxid = $_POST['trxid'];

  if ($user_id && $course_id && $trxid && $phone) {
    $stmt = $conn->prepare("INSERT INTO payments (user_id, course_id, phone, trxid, status) VALUES (?, ?, ?, ?, 'pending')");
    $stmt->bind_param("iiss", $user_id, $course_id, $phone, $trxid);
    $stmt->execute();
    $stmt->close();
    header("Location: ../courses/detail.php/?id=" . $course_id);
    exit();
  } else {
    $error = "Missing information.";
  }
}

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
  <link rel="stylesheet" href="./assets/css/payment.css" />
</head>

<body>
  <!-- HEADER -->
  <?php include('./assets/components/user-nav.php'); ?>

  <!-- MAIN CONTENT -->
  <main class="container">
    <section class="payment-section">
      <div class="payment-container">
        <header class="payment-header">
          <h2>Complete Your Purchase</h2>
          <p>
            Please follow the steps below to complete your payment via bKash.
          </p>
        </header>

        <div class="payment-content">
          <!-- Course Summary -->
          <!-- Show only if course exists -->
          <?php if ($course): ?>
            <input type="hidden" name="course_id" value="<?= $course['id'] ?>">

            <aside class="payment-summary">
              <h3>Course Summary</h3>
              <img src="../courses/assets/img/<?= htmlspecialchars($course['cover_image']) ?>" alt="Course"
                class="summary-image" />
              <h4 class="summary-title"><?= htmlspecialchars($course['name']) ?></h4>
              <p class="summary-author">By <?= htmlspecialchars($course['user_id']) ?></p>
              <!-- Or fetch creator name with JOIN -->
              <p class="summary-price"><strong>Price:</strong> $<?= htmlspecialchars($course['price']) ?></p>
            </aside>

            <p>
              Send exactly <strong>$<?= htmlspecialchars($course['price']) ?></strong> to bKash
              <strong><?= htmlspecialchars($course['bkash_num'] ?? 'Error') ?></strong>.
            </p>
          <?php else: ?>
            <p style="color:red;">Invalid course.</p>
          <?php endif; ?>


          <!-- Payment Instructions & Transaction ID Input -->
          <div class="payment-form">
            <form action="" method="POST">
              <h3>bKash Payment Instructions</h3>

              <div class="bkash-info-box">
                <p>
                  <strong>bKash Number:</strong>
                  <span class="bkash-number"><?= htmlspecialchars($course['bkash_num'] ?? 'Error') ?></span>
                </p>
                <p>
                  Send the amount <strong>exactly $49.00</strong> to the bKash
                  number above.
                </p>
                <p>After sending, please enter the transaction ID below.</p>
              </div>

              <label for="phone">Phone Number</label>
              <input type="tel" id="phone" placeholder="Phone Number" required name="phone" />

              <label for="trxid">bKash Transaction ID</label>
              <input type="text" id="trxid" placeholder="Enter transaction ID" required name="trxid" />

              <button type="submit" class="pay-now-button">
                Submit Payment Review
              </button>
            </form>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- FOOTER -->
  <?php include('./../assets/components/footer.php'); ?>
</body>

</html>