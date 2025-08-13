<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
session_unset();
session_destroy();
$success = urlencode("You have logged out successfully!");
header("Location: /iems/auth/login.php?success=$success");
exit;
?>