<?php require_once('includes/config.php'); 

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
<a href="challenge_create.php">Create New Challenge</a>
<a href="player_list_all.php">View Leaderboard</a>

<?php 

	if(isset($_GET['action'])) {
		switch ($_GET['action']) {
			case 'challenge_creation_success':
				echo '<h3>Challenge successfully created.</h3>';
				break;
		}
	}
	echo '<hr><h3>List of Players</h3>';
	include('player_list_all.php');
	
	if($_SESSION['usertype'] == USER_WATCHER or $_SESSION['usertype'] == USER_ADMIN) {
		echo '<hr><h3>Active challenges</h3>';
		include('challenge_view_all.php');
	}
	
	if($_SESSION['usertype'] == USER_PLAYER or $_SESSION['usertype'] == USER_ADMIN) {

		echo '<hr><h3>My newest challenges</h3>';
		include('challenge_view_mine.php');
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