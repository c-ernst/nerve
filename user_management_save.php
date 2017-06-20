<?php require_once('includes/config.php');
	//if(isset($_POST['submit'])){
		try {
			//insert into database with a prepared statement
			$stmt = $db->prepare('UPDATE member 
								  SET 	promo = :promo,
								  		nname = :nname,
										vname = :vname,
										email = :email,
										street = :street,
										streetnr = :streetnr,
										postcode = :postcode,
										country = :country,
										paypal = :paypal
								  WHERE id = :id');
			$stmt->execute(array(
					':promo' => $_POST['promo'],
					':nname' => $_POST['nname'],
					':vname' => $_POST['vname'],
					':email' => $_POST['email'],
					':street' => $_POST['street'],
					':streetnr' => $_POST['streetnr'],
					':postcode' => $_POST['postcode'],
					':country' => $_POST['country'],
					':paypal' => $_POST['paypal'],
					':id' => $_SESSION['memberID']
				));
			
			//User data updated
			//Redirect to member page
			header('Location: memberpage.php?action=user_management_update_success');
			exit;
			
		//else catch the exception and show the error.
		} catch(PDOException $e) {
		    $error[] = $e->getMessage();
			echo $e->getMessage();
		}

	//}		
?>