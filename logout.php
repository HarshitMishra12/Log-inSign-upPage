<?php
require_once 'includes/auth.php';

$auth = new Auth();
$auth->logout();

header('Location: login.php?message=' . urlencode('Logged out successfully'));
exit();
?>
