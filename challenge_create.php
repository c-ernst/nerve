<h2>Create new challenge</h2>
<?php
		require_once('includes/config.php'); 
		
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
				<input type="integer" name="value" placeholder="Value of Challenge in Token">
				</td></tr><td><tr><td>
				<button type="submit" value="submit" name="submit">Submit</button>
				</td></tr></table>
				</form>';
?>
