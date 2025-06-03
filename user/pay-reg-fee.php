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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $phone = $_POST['phone'];
    $trxid = $_POST['trxid'];

    if ($user_id && $trxid && $phone) {
        $stmt = $conn->prepare("INSERT INTO registration_fees (user_id, phone, trxid, status) VALUES (?, ?, ?, 'pending')");
        $stmt->bind_param("iss", $user_id, $phone, $trxid);
        $stmt->execute();
        $stmt->close();
        header("Location: ./index.php");
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
                    <h2>Complete Your Registration</h2>
                    <p>
                        Please follow the steps below to complete your payment via bKash.
                    </p>
                </header>

                <div class="payment-content">
                    <!-- Payment Instructions & Transaction ID Input -->
                    <div class="payment-form">
                        <form action="" method="POST">
                            <h3>bKash Payment Instructions</h3>

                            <div class="bkash-info-box">
                                <p>
                                    <strong>bKash Number:</strong>
                                    <span class="bkash-number">01213-251436</span>
                                </p>
                                <p>
                                    Send the amount <strong>exactly ৳ 3000 TK</strong> to the bKash
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