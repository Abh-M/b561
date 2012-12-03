<?php

// Inialize session
session_start();

// Delete certain session
unset($_SESSION['userInfoMap']);
unset($_SESSION['username']);
unset($_SESSION['userid']);
unset($_SESSION['userType']);
// Delete all session variables

;
mysql_close($_SESSION['dblink']);

 session_destroy();

// Jump to login page
header('Location: index.php');

?>