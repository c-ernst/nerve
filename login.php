<?php
//include config
require_once('includes/config.php');

//check if already logged in move to home page
if( $user->is_logged_in() ){ header('Location: index.php'); } 

//process login form if submitted
if(isset($_POST['submit'])){

	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if($user->login($username,$password)){ 
		$_SESSION['username'] = $username;
		header('Location: memberpage.php');
		exit;
	
	} else {
		$error[] = 'Wrong username or password.';
	}

}//end if submit
?>

		<form role="form" method="post" action="" autocomplete="off">
				<h2>Please Login</h2>
				<p><a href='./'>Back to home page</a></p>
				<hr>

				<?php
				//check for any errors
				if(isset($error)){
					foreach($error as $error){
						echo '<p>'.$error.'</p>';
					}
				}

				if(isset($_GET['action'])){
					//check the action
					switch ($_GET['action']) {
						case 'reset':
							echo "<h2'>Please check your inbox for a reset link.</h2>";
							break;
						case 'resetAccount':
							echo "<h2>Password changed, you may now login.</h2>";
							break;
					}
				}		
				?>
				<input type="text" name="username" id="username" placeholder="User Name" value="<?php if(isset($error)){ echo $_POST['username']; } ?>">
				<input type="password" name="password" id="password" placeholder="Password">
						 <a href='reset.php'>Forgot your Password?</a>
				<hr>
				<input type="submit" name="submit" value="Login">
			</form>
