<?php
	require_once('includes/config.php'); 

	$stmt = $db->prepare('SELECT id, id_player, id_watcher, duration, description, flag FROM challenge WHERE flag = :flag');
	$stmt->execute(array(':flag' => CHALLENGE_REPORTED));
?>
<table><tr><th>Duration</th><th>Description</th><th>From Player</th><th>For Player</th><th>Status</th></tr>
<?php
	while($row = $stmt->fetch()) {
		// Fetching name of creater of challenge
		$stmt_from = $db->prepare('SELECT username FROM member WHERE id = :id');
		$stmt_from->execute(array(':id' => $row['id_watcher']));
		$row_from = $stmt_from->fetch();
		
		//Fetching name of requested player
		$stmt_for = $db->prepare('SELECT username FROM member WHERE id = :id');
		$stmt_for->execute(array(':id' => $row['id_player']));
		$row_for = $stmt_for->fetch();

		$flag = 'unknown';
		switch($row['flag']){
			case CHALLENGE_OPEN:
				$flag = 'open';
				break;
			case CHALLENGE_ACCEPTED:
				$flag = 'accepted';
				break;
			case CHALLENGE_COMPLETED:
				$flag = 'completed';
				break;
			case CHALLENGE_REPORTED:
				$flag = 'reported';
				break;
		}				
		echo '<tr><td>' . sprintf('%02d', $row['duration']/60) . 'h' . $row['duration']%60 . 'm</td><td>' . $row['description'] . '</td><td>' . $row_from['username'] . '</td><td>' . $row_for['username'] . '</td><td>' . $flag . '</td></tr>';
	}
?>
</table>


