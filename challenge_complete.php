<?php
require_once('includes/config.php');

try {
	//if(isset($_POST['accept'])) {
		$stmt = $db->prepare('UPDATE challenge SET flag = :flag, 
												   completed = :completed,
												   confirmation = :confirmation WHERE id = :id');
		$stmt->execute(array(':flag' => CHALLENGE_COMPLETED,
							 ':completed' => date('Y-m-d G:i:s'),
							 ':confirmation' => $_POST['complete_url'],
							 ':id' => $_POST['complete']));

		//Challenge marked as completed
		//Redirect to member page
		header('Location: memberpage.php?action=challenge_completed');
		exit;							 
	//}
}
catch (Exception $e) {
	echo $e->getMessage();
}
?>