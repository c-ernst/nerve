<?php
require_once('includes/config.php');

try {
	//if(isset($_POST['accept'])) {
		$stmt = $db->prepare('UPDATE challenge SET flag = :flag WHERE id = :id');
		$stmt->execute(array(':flag' => CHALLENGE_CONFIRMED,
							 ':id' => $_POST['confirm']));

		//Challenge confirmed completed
		//Redirect to member page
		header('Location: memberpage.php?action=challenge_confirmed');
		exit;							 
	//}
}
catch (Exception $e) {
	echo $e->getMessage();
}
?>