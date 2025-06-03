<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $conn = new mysqli("localhost", "root", "", "edumarkethub");

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $username = trim($_POST['username']);
  $password = trim($_POST['password']);

  if (empty($username) || empty($password)) {
    $error = "Both fields are required.";
  } else {
    $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ? AND status = 'active'");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($admin = $result->fetch_assoc()) {
      if ($password === $admin['password']) {
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_name'] = $admin['name'];
        header("Location: index.php");
        exit;
      } else {
        $error = "Invalid email or password.";
      }
    } else {
      $error = "Invalid email or password.";
    }

    $stmt->close();
  }

  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EduMarketHub - Login</title>

  <!-- Global & Page Styles -->
  <link rel="stylesheet" href="assets/css/global.css" />
  <link rel="stylesheet" href="assets/css/login.css" />
</head>

<body>
  <div class="login-wrapper">
    <div class="login-box">
      <h1>Admin Login</h1>

      <!-- Login Form -->
      <form id="login-form" action="" method="post">
        <?php if (isset($error)): ?>
          <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <div class="form-group">
          <label for="email">Username</label>
          <input type="text" id="email" name="username" required placeholder="Enter your username" />
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required placeholder="Enter your password" />
        </div>

        <button type="submit">Login</button>
      </form>
    </div>
  </div>
</body>

</html>