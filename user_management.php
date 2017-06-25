<h2>User Management</h2>
<?php
	require_once('includes/config.php');
	require_once('includes/functions.php');

	$stmt = $db->prepare('SELECT username, promo, vname, nname, email, street, streetnr, postcode, country, paypal, type, token FROM member WHERE id = :id');
	$stmt->execute(array(':id' => $_SESSION['memberID']));
	$row = $stmt->fetch();
?>
<form action="user_management_save.php" method="post">
<table><tr><td>
Username:
</td><td>
<?php echo $row['username']; ?> </td></tr>
<tr><td>
<label for="promo">Promo-Video:</label> </td><td>
<input type="url" name="promo" value="<?php echo $row['promo'];?>"/></td></tr>
<tr><td>
<label for="vname">Name:</label> </td><td>
<input type="text" name="vname" value="<?php echo $row['vname'];?>"/></td></tr>
<tr><td>
<label for="nname">Surname:</label> </td><td>
<input type="text" name="nname" value="<?php echo $row['nname'];?>"/></td></tr>
<tr><td>
<label for="email">E-Mail:</label> </td><td>
<input type="email" name="email" value="<?php echo $row['email'];?>"/></td></tr>
<tr><td>
<label for="street">Street:</label> </td><td>
<input type="text" name="street" value="<?php echo $row['street'];?>"/></td></tr>
<tr><td>
<label for="streetnr">Nr:</label> </td><td>
<input type="text" name="streetnr" value="<?php echo $row['streetnr'];?>"/></td></tr>
<tr><td>
<label for="postcode">Postcode:</label> </td><td>
<input type="text" name="postcode" value="<?php echo $row['postcode'];?>"/></td></tr>
<tr><td>
<label for="country">Country:</label> </td><td>
<input type="text" name="country" value="<?php echo $row['country'];?>"/></td></tr>
<tr><td>
<label for="paypal">Paypal:</label> </td><td>
<input type="email" name="paypal" value="<?php echo $row['paypal'];?>"/></td></tr>
<tr><td>
<label>Type:</label> </td><td>
<?php 
	if($row['type'] == USER_WATCHER) {
		echo 'Watcher';
		} 
	elseif($row['type'] == USER_PLAYER) {
		echo 'Player';
	}
	else
		echo 'Admin';
?>
</td></tr>
<tr><td>
<label>Tokencount:</label> </td><td>
<?php if($row['token'])
		echo $row['token'];
	  echo '0';?></td></tr>
<tr><td><button type="submit" value="submit">Save Changes</button></td></tr></table></form>



