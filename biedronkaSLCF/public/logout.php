// logout.php
<?php
session_start();
//clear session data
session_unset();
// destroy the session
session_destroy();
header('Location: index.php');
exit();
