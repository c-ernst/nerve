<?php
	require_once('includes/config.php'); 
	try {
	$stmt = $db->prepare('SELECT id, id_player, id_watcher, duration, description, flag, created, accepted FROM challenge WHERE id_player = :id AND flag <> :flag_confirmed ORDER BY (accepted + INTERVAL duration hour) DESC');
	$stmt->execute(array(':id' => $_SESSION['memberID'],
						 ':flag_confirmed' => CHALLENGE_CONFIRMED));
?>
<table><tr><th>Duration</th><th>Description</th><th>From Player</th><th>Created</th><th>Status</th><th>Time Left</th></tr>
<?php
	while($row = $stmt->fetch()) {
		$stmt_from = $db->prepare('SELECT username FROM member WHERE id = :id');
		$stmt_from->execute(array(':id' => $row['id_watcher']));
		$row_from = $stmt_from->fetch();

		$flag               = 'unknown';
        $time_created       = strtotime($row['created']);
        $time_accepted      = strtotime($row['accepted']);
        $timeleft           = '';
        $challenge_duration = $row['duration'];
        $time_end = '';
        
        switch ($row['flag']) {
            case CHALLENGE_OPEN:
                $flag     = 'open';
                $time_end = $time_created + CHALLENGE_ACCEPT_PERIOD;
                $timeleft = $time_end - time();
                break;
            case CHALLENGE_QUEUED:
                $flag = 'in queue';
                break;
            case CHALLENGE_ACCEPTED:
                $flag     = 'accepted';
                $time_end = $time_accepted + $challenge_duration * 60;
                $timeleft = $time_end - time();
                break;
            case CHALLENGE_COMPLETED:
                $flag = 'marked completed';
                break;
            case CHALLENGE_CONFIRMED:
                $flag = 'confirmed completed';
                break;
            case CHALLENGE_REPORTED:
                $flag = 'reported';
                break;
        }
        if ($timeleft < 0) {
            continue;
        }			
		echo 	'<tr><td>' 
				. sprintf('%02d', $row['duration']/60) 
				. 'h' 
				. $row['duration']%60 
				. 'm</td><td width="400px">' 
				. $row['description'] 
				. '</td><td>' 
				. $row_from['username'] 
				. '</td><td>' 
				. date("H:i:s",$time_created) 
				. '</td><td>' 
				. $flag 
				.  '</td><td>' 
				. sprintf("%02dh %02dm %02ds",$timeleft/60/60, $timeleft/60%60, $timeleft %60)
				. '</td>';
		if($row['flag'] == CHALLENGE_QUEUED) {
				echo	'<td><form action="challenge_accept.php" method="post"><button type="submit" name="accept" value="'
						. $row['id']
						.'">Accept</button></form></td>';
		}
		if($row['flag'] == CHALLENGE_ACCEPTED) {
				echo	'<td><form action="challenge_complete.php" method="post"><label for="complete_url">Proof-URL: </label><input type="url" name="complete_url"></input><button type="submit" name="complete" value="'
						. $row['id']
						. '">Complete</button></form>';
		}
		echo	'</tr>';
	}
	}
	catch(Exception $e) {
			echo $e->getMessage();
		}
?>
</table>


