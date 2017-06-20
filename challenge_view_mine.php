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
				. sprintf("%02dh %02dm %02ds",$timeleft/60/60, $timeleft/60%60, $timeleft %60) ;
		if($row['flag'] == CHALLENGE_OPEN) {
				echo	'</td><td><button type="submit" value="'
						. $row['id']
						.'">Accept</button>';
		}
		echo	'</td></tr>';
	}
	}
	catch(Exception $e) {
			echo $e->getMessage();
		}
?>
</table>


