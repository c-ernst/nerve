<?php
	require_once('includes/config.php'); 
	try {
	$stmt = $db->prepare('SELECT * FROM challenge WHERE id_watcher = :id_watcher');
	$stmt->execute(array(':id_watcher' => $_SESSION['memberID']));
?>
<table><tr><th>Duration</th><th>Description</th><th>For Player</th><th>Created</th><th>Status</th><th>Time Left</th></tr>
<?php
	while($row = $stmt->fetch()) {
		$stmt_for = $db->prepare('SELECT username FROM member WHERE id = :id');
		$stmt_for->execute(array(':id' => $row['id_player']));
		$row_for = $stmt_for->fetch();

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
				. $row_for['username'] 
				. '</td><td>' 
				. date("H:i:s",$time_created) 
				. '</td><td>' 
				. $flag 
				.  '</td><td>' 
				. sprintf("%02dh %02dm %02ds",$timeleft/60/60, $timeleft/60%60, $timeleft %60)
				. '</td>';
		if($row['flag'] == CHALLENGE_COMPLETED) {
				echo	'<td><form action="challenge_confirm.php" method="post"><a href="'
						. $row['confirmation']
						. '">Open Video</a> <button type="submit" name="confirm" value="'
						. $row['id']
						. '">Confirm</button></form></td>';
		}
		echo '</tr>';
		}
	}
	catch(Exception $e) {
			echo $e->getMessage();
		}
?>
</table>


