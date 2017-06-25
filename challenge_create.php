<h2>Create new challenge</h2>
<?php
		require_once('includes/config.php');
		require_once('includes/functions.php');
		
		$stmt = $db->prepare('SELECT id, username FROM member WHERE type = :type_player');
		$stmt->execute(array(':type_player' => USER_PLAYER));

		echo '	<form method="post" action="challenge_submit.php">
				<table><tr><td>
				<label for="player">Player: </label>
				</td><td>						
				<select name="player">';
		
		while ($row = $stmt->fetch()){
			echo '<option value="' . $row['id'] . '">' . $row['username'] . '</option>';
		}
		
		$tokencount = get_tokencount($db, $_SESSION['memberID']);
		
		echo '</select>
				</td></tr><tr><td>
				<label for="description">Description:</label>
				</td><td>
				<textarea name="description"></textarea>
				</td></tr><tr><td>
				<label for="deadline">Deadline:</label>
				</td><td>
				<input type="integer" name="duration" placeholder="Minutes">
				</td></tr><tr><td>
				<label for="value">Token</label>
				</td><td>
				<input type="number" name="value" min="0" max="'
				. $tokencount
				. '">
				</td></tr><td><tr><td>
				<button type="submit" value="submit" name="submit"';
		if($tokencount < 5) {
			echo ' disabled';
		}
		echo    '>Submit</button>
				</td></tr></table>
				</form>';
		if($tokencount < 5) {
			echo '<p>Not enough token to create a challenge.</p>';
		}
?>
