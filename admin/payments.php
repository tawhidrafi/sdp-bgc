<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EduMarketHub - Admin</title>

  <!-- Font Awesome -->
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
    rel="stylesheet" />

  <!-- Stylesheets -->
  <link rel="stylesheet" href="./assets/css/global.css" />
  <link rel="stylesheet" href="./assets/css/payments.css" />
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
              <th>Course</th>
              <th>Creator</th>
              <th>User</th>
              <th>User ID</th>
              <th>Method</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>#P001</td>
              <td>2025-05-01</td>
              <td>Intro to HTML</td>
              <td>Jane Doe</td>
              <td>Michael Scott</td>
              <td>#U101</td>
              <td>PayPal</td>
              <td><span class="status paid">Paid</span></td>
              <td class="action-buttons">
                <button class="btn approve">Approve</button>
                <button class="btn reject">Not Found</button>
              </td>
            </tr>
            <tr>
              <td>#P002</td>
              <td>2025-05-02</td>
              <td>Python for All</td>
              <td>John Smith</td>
              <td>Pam Beesly</td>
              <td>#U102</td>
              <td>Stripe</td>
              <td><span class="status pending">Pending</span></td>
              <td class="action-buttons">
                <button class="btn approve">Approve</button>
                <button class="btn reject">Not Found</button>
              </td>
            </tr>
            <tr>
              <td>#P003</td>
              <td>2025-05-02</td>
              <td>Figma Notes</td>
              <td>Alice Green</td>
              <td>Jim Halpert</td>
              <td>#U103</td>
              <td>Card</td>
              <td><span class="status paid">Paid</span></td>
              <td class="action-buttons">
                <button class="btn approve">Approve</button>
                <button class="btn reject">Not Found</button>
              </td>
            </tr>
            <tr>
              <td>#P004</td>
              <td>2025-05-03</td>
              <td>SEO Guide</td>
              <td>Emily White</td>
              <td>Dwight Schrute</td>
              <td>#U104</td>
              <td>Bank Transfer</td>
              <td><span class="status failed">Failed</span></td>
              <td class="action-buttons">
                <button class="btn approve">Approve</button>
                <button class="btn reject">Not Found</button>
              </td>
            </tr>
            <tr>
              <td>#P005</td>
              <td>2025-05-03</td>
              <td>React Snippets</td>
              <td>Mike Lee</td>
              <td>Angela Martin</td>
              <td>#U105</td>
              <td>PayPal</td>
              <td><span class="status paid">Paid</span></td>
              <td class="action-buttons">
                <button class="btn approve">Approve</button>
                <button class="btn reject">Not Found</button>
              </td>
            </tr>
            <tr>
              <td>#P006</td>
              <td>2025-05-04</td>
              <td>Design Tips</td>
              <td>David Brown</td>
              <td>Kevin Malone</td>
              <td>#U106</td>
              <td>UPI</td>
              <td><span class="status pending">Pending</span></td>
              <td class="action-buttons">
                <button class="btn approve">Approve</button>
                <button class="btn reject">Not Found</button>
              </td>
            </tr>
            <tr>
              <td>#P007</td>
              <td>2025-05-05</td>
              <td>Vue Crash Course</td>
              <td>Susan Moore</td>
              <td>Oscar Martinez</td>
              <td>#U107</td>
              <td>Stripe</td>
              <td><span class="status paid">Paid</span></td>
              <td class="action-buttons">
                <button class="btn approve">Approve</button>
                <button class="btn reject">Not Found</button>
              </td>
            </tr>
            <tr>
              <td>#P008</td>
              <td>2025-05-05</td>
              <td>Marketing Notes</td>
              <td>Robert Clark</td>
              <td>Stanley Hudson</td>
              <td>#U108</td>
              <td>Card</td>
              <td><span class="status failed">Failed</span></td>
              <td class="action-buttons">
                <button class="btn approve">Approve</button>
                <button class="btn reject">Not Found</button>
              </td>
            </tr>
            <tr>
              <td>#P009</td>
              <td>2025-05-06</td>
              <td>Java Essentials</td>
              <td>Daniel Kim</td>
              <td>Phyllis Vance</td>
              <td>#U109</td>
              <td>UPI</td>
              <td><span class="status paid">Paid</span></td>
              <td class="action-buttons">
                <button class="btn approve">Approve</button>
                <button class="btn reject">Not Found</button>
              </td>
            </tr>
            <tr>
              <td>#P010</td>
              <td>2025-05-06</td>
              <td>ML Basics</td>
              <td>Linda Ray</td>
              <td>Creed Bratton</td>
              <td>#U110</td>
              <td>Bank Transfer</td>
              <td><span class="status pending">Pending</span></td>
              <td class="action-buttons">
                <button class="btn approve">Approve</button>
                <button class="btn reject">Not Found</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>
  </main>

  <!-- FOOTER -->
  <?php include('./../assets/components/footer.php'); ?>
</body>

</html>