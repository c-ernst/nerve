<?php
ob_start();
session_start();

//set timezone
date_default_timezone_set('Europe/Berlin');

//database credentials
define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','');
define('DBNAME','nerve');

// User Types
define('USER_WATCHER',1001);
define('USER_PLAYER', 1337);
define('USER_ADMIN',2338);
define('USER_SPONSOR',500);

// Challenge States
define('CHALLENGE_OPEN',1000);
define('CHALLENGE_QUEUED',1500);
define('CHALLENGE_ACCEPTED',2000);
define('CHALLENGE_COMPLETED',3000);
define('CHALLENGE_CONFIRMED',3100);
define('CHALLENGE_REPORTED',4000);

// Time to accept an open challenge (8 hours)
define('CHALLENGE_ACCEPT_PERIOD', 8 * 60 * 60);

//application address
define('DIR','localhost');
define('SITEEMAIL','master.of.disaster@nerve.com');

try {

    //create PDO connection 
    $db = new PDO("mysql:host=".DBHOST.";port=3306;dbname=".DBNAME, DBUSER, DBPASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    //show error
    echo '<p>'.$e->getMessage().'</p>';
    exit;
}

//include the user class, pass in the database connection
include('classes/user.php');
$user = new User($db); 
?>