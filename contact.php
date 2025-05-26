<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EduMArketHub - Contact Us</title>

  <!-- Font Awesome -->
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
    rel="stylesheet" />

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
              <p>123 Street, New York, USA</p>
            </div>
          </div>

          <div class="info-box">
            <div class="icon-box gray">
              <i class="fa fa-phone-alt"></i>
            </div>
            <div class="info-details">
              <h4>Call Us</h4>
              <p>+012 345 6789</p>
            </div>
          </div>

          <div class="info-box">
            <div class="icon-box yellow">
              <i class="fa fa-envelope"></i>
            </div>
            <div class="info-details">
              <h4>Email Us</h4>
              <p>info@example.com</p>
            </div>
          </div>
        </div>

        <!-- Contact Form -->
        <div class="contact-form-container">
          <h6 class="section-subtitle">Need Help?</h6>
          <h1 class="section-title">Send Us A Message</h1>

          <form class="contact-form">
            <div class="form-row">
              <input type="text" placeholder="Your Name" required />
              <input type="email" placeholder="Your Email" required />
            </div>
            <input type="text" placeholder="Subject" required />
            <textarea rows="5" placeholder="Message" required></textarea>
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