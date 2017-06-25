<?php
require_once('includes/config.php');
require_once('includes/functions.php');

try {
	//if(isset($_POST['vote'])) {
		$stmt = $db->prepare('SELECT * FROM challenge_votes WHERE id_challenge = :id_challenge AND id_member = :id_member');
		$stmt->execute(array('id_challenge' => $_POST['vote'],
							 'id_member' => $_SESSION['memberID']));
		if(!$stmt->fetch()) {		
			$stmt_insert = $db->prepare('INSERT INTO challenge_votes (id_challenge, id_member) VALUES (:id_challenge, :id_member)');
			$stmt_insert->execute(array(':id_challenge' => $_POST['vote'],
		  								 ':id_member' => $_SESSION['memberID']));
						
			if(get_votes($db,$_POST['vote']) > get_membercount($db) * VOTE_PERCENTAGE_REQUIRED) {
				try{
					$stmt_update = $db->prepare('UPDATE challenge SET flag = :flag WHERE id = :id');
					$stmt_update->execute(array(':flag' => CHALLENGE_QUEUED,
										 ':id' => $_POST['vote']));
				}
				catch(Exception $e) {
					echo $e->getMessage();
				}
			}
			
			//Challenge successfully voted
			//Redirect to member page
			header('Location: memberpage.php?action=challenge_voted');
			exit;							 
		}
		//Duplicate vote found
		//Redirect
		header('Location: memberpage.php?action=vote_duplicate');
		exit;		
	//}
}
catch (Exception $e) {
	echo $e->getMessage();
}
?>