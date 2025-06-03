<?php
session_start(); // Start the session
if (!isset($_SESSION['user_id'])) {
    header("Location: ./login.php");
    exit();
}

// Destroy all session data
$_SESSION = [];
session_unset();
session_destroy();

// Redirect to login page
header("Location: login.php");
exit;
