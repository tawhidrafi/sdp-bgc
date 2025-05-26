<?php
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Database connection
  $conn = new mysqli("localhost", "root", "", "edumarkethub");

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Get input values
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm-password'];

  // Basic validation
  if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
    die("All fields are required.");
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format.");
  }

  if ($password !== $confirm_password) {
    die("Passwords do not match.");
  }

  // Check if email already exists
  $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
  $check->bind_param("s", $email);
  $check->execute();
  $check->store_result();

  if ($check->num_rows > 0) {
    die("Email is already registered.");
  }

  // Hash password
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // Insert user
  $insert = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
  $insert->bind_param("sss", $name, $email, $hashed_password);

  if ($insert->execute()) {
    header("Location: login.php");
    exit();
  } else {
    echo "Error: " . $conn->error;
  }

  // Close connections
  $check->close();
  $insert->close();
  $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EduMarketHub - Register</title>

  <!-- Global & Page Styles -->
  <link rel="stylesheet" href="assets/css/global.css" />
  <link rel="stylesheet" href="assets/css/register.css" />
</head>

<body>
  <div class="register-wrapper">
    <div class="register-box">
      <h1>Create an Account</h1>

      <!-- Register Form -->
      <form
        id="register-form"
        action=""
        method="POST">
        <div class="form-group">
          <label for="name">Full Name</label>
          <input
            type="text"
            id="name"
            name="name"
            required
            placeholder="Enter your full name" />
        </div>

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
            placeholder="Create a password" />
        </div>

        <div class="form-group">
          <label for="confirm-password">Confirm Password</label>
          <input
            type="password"
            id="confirm-password"
            name="confirm-password"
            required
            placeholder="Confirm your password" />
        </div>

        <button type="submit">Register</button>
      </form>

      <div class="links">
        <a href="login.html">Already have an account? Login here</a>
      </div>
    </div>
  </div>
</body>

</html>