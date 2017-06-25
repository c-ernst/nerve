<?php
	require_once('includes/config.php');
	require_once('includes/functions.php');
?>
<table><tr><th>Rank</th><th>Username</th><th>Promotion-Video</th><th>Score</th></tr>
<?php
	$ladder = get_ladder($db);

	for($i = 0; $i < 3; $i++){
		echo 	'<tr><td>' 
				. ($i + 1)
				. '</td><td>'
				. $ladder[$i]["usr"]
				. '</td><td><a href="' 
				. $ladder[$i]["promo"]
				. '">Video</a></td>'
				. '<td>'
				. $ladder[$i]["score"]
				. '</tr>';
	}
?>
</table>


