<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Database connection using MySQLi
  $conn = new mysqli("localhost", "root", "", "edumarkethub");

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $email = trim($_POST['email']);
  $password = trim($_POST['password']);

  // Check for empty fields
  if (empty($email) || empty($password)) {
    $error = "Both fields are required.";
  } else {
    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND status = 'active'");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
      // Verify password
      if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        header("Location: user/index.php"); // Redirect to dashboard
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
      <h1>Login to EduMarketHub</h1>

      <!-- Login Form -->
      <form id="login-form" action="" method="post">
        <?php if (isset($error)) : ?>
          <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <div class="form-group">
          <label for="email">Email</label>
          <input
            type="email"
            id="email"
            name="email"
            required
            placeholder="Enter your email" />
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input
            type="password"
            id="password"
            name="password"
            required
            placeholder="Enter your password" />
        </div>

        <button type="submit">Login</button>
      </form>

      <div class="links">
        <a href="register.html">Don't have an account? Register here</a>
        <a href="#">Forgot Password?</a>
      </div>
    </div>
  </div>
</body>

</html>