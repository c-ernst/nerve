<?php require_once('includes/config.php');
		try {
			//insert into database with a prepared statement
			
			$stmt = $db->prepare('INSERT INTO challenge (id_player, id_watcher, duration, description, flag, value) VALUES (:id_player, :id_watcher, :duration, :description, :flag, :value)');
			$stmt->execute(array(
				':id_player' => $_POST['player'],
				':id_watcher' => $_SESSION['memberID'],
				':duration' => $_POST['duration'],
				':description' => $_POST['description'],
				':flag' => CHALLENGE_OPEN,
				':value' => (5 + $_POST['value'])
				));
			
			//Challenge successful created
			//Redirect to member page
			header('Location: memberpage.php?action=challenge_creation_success');
			exit;
			
		//else catch the exception and show the error.
		} catch(PDOException $e) {
		    $error[] = $e->getMessage();
			echo $e->getMessage();
		}
?>