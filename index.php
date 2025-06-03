<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EduMarketHub - Home</title>

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />

  <!-- Stylesheets -->
  <link rel="stylesheet" href="./assets/css/global.css" />
  <link rel="stylesheet" href="./assets/css/home.css" />
</head>

<body>
  <!-- Navigation -->
  <?php include('assets/components/nav.php'); ?>

  <!-- Main Content -->
  <main>
    <!-- Hero Section -->
    <section class="hero-section">
      <div class="hero-content">
        <h2 class="hero-subtitle">Learn from home...</h2>
        <h2 class="hero-subtitle">Share with others...</h2>
        <h2 class="hero-subtitle">Learn with your friends...</h2>
      </div>
    </section>

    <!-- About Section -->
    <section class="about-section">
      <div class="about-container container">
        <div class="about-image">
          <img src="./assets/img/home-1.jpg" alt="About Us" />
        </div>
        <div class="about-content">
          <h6 class="section-subtitle">About Us</h6>
          <h2 class="section-title">
            First Choice For Online Education Anywhere
          </h2>
          <p>Tempor erat elitr at rebum... Amet erat amet et magna</p>
        </div>
      </div>
    </section>

    <!-- Features Section -->
    <section class="feature-section">
      <div class="feature-container container">
        <div class="feature-text">
          <h6 class="section-subtitle">Why Choose Us?</h6>
          <h2 class="section-title">
            Why You Should Start Learning with Us?
          </h2>

          <div class="feature-item">
            <div class="icon-box blue">
              <i class="fa fa-graduation-cap"></i>
            </div>
            <div>
              <h4>Skilled Instructors</h4>
              <p>
                Labore rebum duo est Sit dolore eos sit tempor eos stet...
              </p>
            </div>
          </div>

          <div class="feature-item">
            <div class="icon-box dark"><i class="fa fa-certificate"></i></div>
            <div>
              <h4>International Certificate</h4>
              <p>
                Labore rebum duo est Sit dolore eos sit tempor eos stet...
              </p>
            </div>
          </div>

          <div class="feature-item">
            <div class="icon-box yellow">
              <i class="fa fa-book-reader"></i>
            </div>
            <div>
              <h4>Online Classes</h4>
              <p>
                Labore rebum duo est Sit dolore eos sit tempor eos stet...
              </p>
            </div>
          </div>
        </div>

        <div class="feature-image">
          <img src="./assets/img/home-2.jpg" alt="Feature Image" />
        </div>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <?php include('assets/components/footer.php'); ?>

</body>

</html>