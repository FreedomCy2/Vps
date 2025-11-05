<?php
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session completely
session_destroy();

// Optional: Clear cookies if used for login
if (isset($_COOKIE['remember_token'])) {
    setcookie('remember_token', '', time() - 3600, '/');
}

// Redirect user to the login page
header("Location: login.php");
exit;
?>
