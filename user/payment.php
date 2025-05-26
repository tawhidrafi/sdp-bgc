<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EduMarketHub - User</title>

  <!-- Font Awesome -->
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
    rel="stylesheet" />

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
          <aside class="payment-summary">
            <h3>Course Summary</h3>
            <img
              src="./assets/img/courses-2.jpg"
              alt="Course"
              class="summary-image" />
            <h4 class="summary-title">JavaScript Essentials & Projects</h4>
            <p class="summary-author">By John Doe</p>
            <p class="summary-price"><strong>Price:</strong> $49.00</p>
          </aside>

          <!-- Payment Instructions & Transaction ID Input -->
          <div class="payment-form">
            <form>
              <h3>bKash Payment Instructions</h3>

              <div class="bkash-info-box">
                <p>
                  <strong>bKash Number:</strong>
                  <span class="bkash-number">01712-121212</span>
                </p>
                <p>
                  Send the amount <strong>exactly $49.00</strong> to the bKash
                  number above.
                </p>
                <p>After sending, please enter the transaction ID below.</p>
              </div>

              <label for="phone">Phone Number</label>
              <input
                type="tel"
                id="email"
                placeholder="Phone Number"
                required />

              <label for="trxid">bKash Transaction ID</label>
              <input
                type="text"
                id="trxid"
                placeholder="Enter transaction ID"
                required />

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