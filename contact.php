<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $conn = new mysqli("localhost", "root", "", "edumarkethub");

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $subject = trim($_POST['subject']);
  $message = trim($_POST['message']);

  $stmt = $conn->prepare("INSERT INTO messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $name, $email, $subject, $message);

  if ($stmt->execute()) {
    header("Location: ./contact.php");
  }

  $stmt->close();
  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EduMArketHub - Contact Us</title>

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="./assets/css/global.css" />
  <link rel="stylesheet" href="./assets/css/contact.css" />
</head>

<body>
  <!-- header -->
  <?php include('assets/components/nav.php'); ?>

  <main id="main-content" class="main-content">
    <section class="contact-section">
      <div class="contact-container">
        <!-- Contact Info -->
        <div class="contact-info">
          <div class="info-box">
            <div class="icon-box blue">
              <i class="fa fa-map-marker-alt"></i>
            </div>
            <div class="info-details">
              <h4>Our Location</h4>
              <p>Chandgaon, Chatoogram, Bangladesh</p>
            </div>
          </div>

          <div class="info-box">
            <div class="icon-box gray">
              <i class="fa fa-phone-alt"></i>
            </div>
            <div class="info-details">
              <h4>Call Us</h4>
              <p>+880 1234 141214</p>
            </div>
          </div>

          <div class="info-box">
            <div class="icon-box yellow">
              <i class="fa fa-envelope"></i>
            </div>
            <div class="info-details">
              <h4>Email Us</h4>
              <p>contact@edumarkethub.com</p>
            </div>
          </div>
        </div>

        <!-- Contact Form -->
        <div class="contact-form-container">
          <h6 class="section-subtitle">Need Help?</h6>
          <h1 class="section-title">Send Us A Message</h1>

          <form class="contact-form" method="post" action="" enctype="multipart/form-data">
            <div class="form-row">
              <input type="text" name="name" placeholder="Your Name" required />
              <input type="email" name="email" placeholder="Your Email" required />
            </div>
            <input type="text" placeholder="Subject" name="subject" required />
            <textarea rows="5" placeholder="Message" name="message" required></textarea>
            <button type="submit">Send Message</button>
          </form>
        </div>
      </div>
    </section>
  </main>

  <!-- footer -->
  <?php include('assets/components/footer.php'); ?>
</body>

</html>