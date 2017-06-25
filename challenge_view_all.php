<?php
require_once('includes/config.php');
try {
    
    $stmt = $db->prepare('SELECT id, id_player, id_watcher, duration, description, flag, created, accepted FROM challenge WHERE flag <> :flag_confirmed AND flag <> :flag_reported ORDER BY (accepted + INTERVAL duration minute) DESC');
    $stmt->execute(array(
        ':flag_confirmed' => CHALLENGE_CONFIRMED,
        ':flag_reported' => CHALLENGE_REPORTED
    ));
}
catch (Exception $e) {
    echo $e->getMessage();
}
?>

<table>
  <tr>
    <th>Duration</th>
    <th>Description</th>
    <th>For Player</th>
    <th>Created</th>
    <th>Status</th>
    <th>Time Left </th>
    <th>Votes</th>
  </tr>
  <?php
try {
    while ($row = $stmt->fetch()) {
        try {
            $stmt_for = $db->prepare('SELECT username FROM member WHERE id = :id');
            $stmt_for->execute(array(
                ':id' => $row['id_player']
            ));
            $row_for = $stmt_for->fetch();
        }
        catch (Exeption $e) {
            echo $e->getMessage();
        }
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
        echo '<tr><td>' 
			. sprintf('%02d', $row['duration'] / 60) 
			. 'h ' 
			. $row['duration'] % 60 
			. 'm</td><td width="400px">' 
			. $row['description'] 
			. '</td><td>' 
			. $row_for['username'] 
			. '</td><td>' 
			. date("H:i:s", $time_created) 
			. '</td><td>' 
			. $flag . '</td><td>' 
			. sprintf("%02dh %02dm %02ds",$timeleft/60/60, $timeleft/60%60, $timeleft %60)
			. '</td><td>'
			. get_votes($db,$row['id'])
			. ' / '
			. get_membercount($db) * VOTE_PERCENTAGE_REQUIRED
			. '</td><td>';
			if($row['flag'] == CHALLENGE_OPEN) {
				echo '<form action="challenge_vote.php" method="post"><button type="submit" name="vote" value="'
					. $row['id']
					. '">Vote</button></form>';
			}
			if($row['flag'] != CHALLENGE_REPORTED) {
					echo	'</td><td><form action="challenge_report.php" method="post"><button type="submit" name="report" value="'
							. $row['id']
							.'">Report</button></form>';
		}
				echo	'</td></tr>';
    }
}
catch (Exception $e) {
    echo $e->getMessage();
}
?>
</table>