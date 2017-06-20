<?php 
require('includes/config.php'); 
//Logout
$user->logout(); 
//Return to Homepage
header('Location: index.php');
exit;
?>