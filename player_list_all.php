<?php
	require_once('includes/config.php'); 

	$stmt = $db->prepare('SELECT username, promo FROM member WHERE type = :type');
	$stmt->execute(array(':type' => USER_PLAYER));
?>
<table><tr><th>Username</th><th>Promotion-Video</th></tr>
<?php
	while($row = $stmt->fetch()) {
		echo 	'<tr><td>' 
				. $row['username'] 
				. '</td><td><a href="' 
				. $row['promo']
				. '">Video</a></td></tr>';
	}
?>
</table>


