<h2>Current Sponsor</h2>
<?php 
require_once('includes/config.php');
try {
	$stmt = $db->prepare('SELECT * FROM sponsor WHERE CURRENT_TIMESTAMP() BETWEEN start AND end');
	$stmt->execute();
	$row = $stmt->fetch();
	
	echo '<table><tr><td>'
			. '<img height="50px" src="'
			. $row['logo_url']
			. '"></img>'
			. '</td><td>'
			. $row['name']
			. '</td></tr>'
			. '<tr><td>1st place: '
			. $row['first_place']
			. '</td><td>2nd place: '
			. $row['second_place']
			. '</td><td>3rd place: '
			. $row['third_place']
			. '</td></tr><tr><td>from: '
			. $row['start']
			. '</td><td>until: '
			. $row['end']
			. '</td></tr>'
			. '</table>';
}
catch(Exception $e){
	$e->getMessage();
}
?>