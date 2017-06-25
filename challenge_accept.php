<?php
require_once('includes/config.php');

try {
	//if(isset($_POST['accept'])) {
		$stmt = $db->prepare('UPDATE challenge SET flag = :flag, accepted = :accepted WHERE id = :id');
		$stmt->execute(array(':flag' => CHALLENGE_ACCEPTED,
							 ':accepted' => date('Y-m-d G:i:s'),
							 ':id' => $_POST['accept']));

		//Challenge successfully accepted
		//Redirect to member page
		header('Location: memberpage.php?action=challenge_accepted');
		exit;							 
	//}
}
catch (Exception $e) {
	echo $e->getMessage();
}
?>