<hr><strong>My score: </strong>
<?php
	include_once('includes/functions.php');
	$score = calculate_score($db, $_SESSION['memberID']);
	echo $score;
?>