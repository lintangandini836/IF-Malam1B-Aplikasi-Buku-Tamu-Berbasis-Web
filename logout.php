<?php
// logout.php
session_start();

// Hancurkan semua variabel sesi
$_SESSION = array();

// Hancurkan sesi
session_destroy();

// Redirect ke halaman depan
header("Location: front-end.php");
exit();
?>