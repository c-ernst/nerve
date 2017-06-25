<?php 

require_once('includes/config.php'); 
require_once('includes/functions.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); } 

//custom welcome message
if($_SESSION['usertype'] == USER_WATCHER){
	$usertype = 'Watcher';
}
elseif($_SESSION['usertype'] == USER_PLAYER){
	$usertype = 'Player';
}
else {
	$usertype = 'Admin';
}
?>

<h2>Member only page - Welcome <?php echo $usertype . ' ' . $_SESSION['username']; ?></h2>

<a href="user_management.php">My Profile</a>
<a href="player_list_all.php">View Leaderboard</a>

<?php 

	if(isset($_GET['action'])) {
		switch ($_GET['action']) {
			case 'challenge_creation_success':
				echo '<h3>Challenge successfully created.</h3>';
				break;
			case 'user_management_update_success':
				echo '<h3>Profile data successfully updated.</h3>';
				break;
			case 'challenge_accepted':
				echo '<h3>Challenge accepted!</h3>';
				break;
			case 'challenge_confirmed':
				echo '<h3>Challenge confirmed!</h3>';
				break;
			case 'challenge_voted':
				echo '<h3>Vote confirmed!</h3>';
				break;
			case 'vote_duplicate':
				echo '<h3>Duplicate vote not allowed.</h3>';
				break;
		}
	}
	include('sponsor_current.php');
	
	echo '<hr><h3>Current Top 3</h3>';
	include('player_list_top3.php');
	
	if($_SESSION['usertype'] == USER_WATCHER or $_SESSION['usertype'] == USER_ADMIN) {
		echo '<hr><h3>Active challenges</h3>';
		include('challenge_view_all.php');
		echo '<hr><h3>My created challenges</h3>';
		include('challenge_view_watcher.php');
		echo '<a href="challenge_create.php">Create New Challenge</a>';
	}
	
	if($_SESSION['usertype'] == USER_PLAYER or $_SESSION['usertype'] == USER_ADMIN) {
		include('player_score.php');
		echo '<hr><h3>My newest challenges</h3>';
		include('challenge_view_player.php');
	}
	if($_SESSION['usertype'] == USER_ADMIN) {
		echo '<hr><h2> Admin tools</h2>';
		echo '<a href="sponsor_management.php">Manage Sponsors</a>';
		echo '<h3>Flagged challenges</h3>';
		include('challenge_flagged.php');			
	}
?>

<hr />
<a href='logout.php'>Logout</a>
<hr />