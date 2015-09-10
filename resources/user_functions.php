<?php


$expire_time = 	100;		//the session expire time in minutes
$logged_in_protect = '<h2>Oops!</h2><p>You need to be logged in to do that. <a href="new_user.php">Signup</a> or login.</p>';

function create_user($firstname, $lastname, $username, $email, $password, $password_again, $institution_id, $position, $email){
	//create array to hold errors. If the error array is empty, the user was successfully created.
	$errors = array();
	
	//check if the username already exists
	if (user_id_from_username($username) != false){
		$errors[] = 'Username already exists.';
	}
	
	//check if passwords match. If not, return error.
	if($password != $password_again){
		$errrors[] = 'Passwords do not match';
	}
	
	//check if the provided institution exists in the db
	
	//check if email address exists
	if(user_id_from_email($email)){
		$errors[] = 'A user with that email already exists';
	}
	
	//check if email address appears to be an email address
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$errors[] = 'Invalid email format';
	}
	
	//user creation credentials appear acceptable, create user
	if(empty($errors)){	
		//set defaults
		$access_level = 0;
		$activated = 0;
		$failed_logins = 0;
		//create salt
		$salt = bin2hex(openssl_random_pseudo_bytes(16));
		//hash pw with salt
		$salted_pw = hash("sha256", $salt . $password);
		
		//add user info to db
		global $dbh;
		$stmt = ("INSERT INTO users(username, firstname, lastname, email, access_level, salt, password, institution_id, position, activated, failed_logins) 
		VALUES (:username, :firstname, :lastname, :email, :access_level, :salt, :password, :institution_id, :position, :activated, :failed_logins)");
		$stmt = $dbh->prepare($stmt);
		$stmt->bindValue(':username', $username);
		$stmt->bindValue(':firstname', $firstname);
		$stmt->bindValue(':lastname', $lastname);
		$stmt->bindValue(':email', $email);
		$stmt->bindValue(':access_level', $access_level);
		$stmt->bindValue(':salt', $salt);
		$stmt->bindValue(':password', $salted_pw);
		$stmt->bindValue(':institution_id', $institution_id);
		$stmt->bindValue(':position', $position);
		$stmt->bindValue(':activated', $activated);
		$stmt->bindValue(':failed_logins', $failed_logins);
		
		//execute
		$stmt->execute();
		
		return true;	//user created successfully
		
	} else {
		return $errors;
	}
}

function login($username, $password){
	$errors = array();
	//check if the username exists. Return error if not.
	$user_id = user_id_from_username($username);
	
	if ($user_id == 0){
		$errors[] = 'Username and password do not match';
		return $errors;
	} else {
		//get salt
		global $dbh;
		$stmt= $dbh->prepare('SELECT `salt` FROM `users` WHERE `user_id` = :user_id');
		$stmt->bindValue(':user_id',$user_id);
		$stmt->execute();
		//salt the password and hash
		$salt = $stmt->fetchall()[0]['salt'];
		$salted_pw = hash("sha256", $salt . $password);
				
		//check if they match
		$stmt = $dbh->prepare('SELECT COUNT(`user_id`) FROM `users` WHERE `user_id`= :user_id AND `password` = :password');
		$stmt->bindValue(':user_id',$user_id);
		$stmt->bindValue(':password',$salted_pw);
		$stmt->execute();
		$result = $stmt->fetchall();
		
		//check if there is a record that matches
		if($result[0]['COUNT(`user_id`)'] ==1){
			//start session and set session variables
			$_SESSION['logged_in'] = 1;
			$_SESSION['user_id'] = $user_id;
			global $expire_time;
			$_SESSION['expire_time'] = time() + $expire_time * 60;
			return true;
		} else {
			$errors[] = ('Username and password do not match');
			return $errors;
		}
	}
}
function get_user_info($column, $user_id){
	global $dbh;
	$stmt=$dbh->prepare('SELECT ' . $column . ' FROM `users` WHERE `user_id` = :user_id');
	$stmt->bindParam(':user_id', $user_id);
	$stmt->execute();
	$result = $stmt->fetchall()[0][$column];
	return $result;
}

function update_user_info($assoc_array, $user_id){
	$errors = array();
	global $dbh;
	foreach($assoc_array as $k=> $v){
		if($k == 'email'){
			if(!filter_var($v, FILTER_VALIDATE_EMAIL)){
				$errors[] = 'invalid email address';
			}
		} else{ 
			$stmt=$dbh->prepare('UPDATE `users` SET ' . $k . '= :' . $k .' WHERE `user_id` = :user_id');
			$stmt->bindValue(':'.$k,$v);
			$stmt->bindValue(':user_id', $user_id);
			$stmt->execute();
		}
	}
	if (!empty($errors)){
		return $errors;
	}
	return true;
}
function protect($access_level= 0,$die=true, $timeout=true){
	//check login status
	if(!isset($_SESSION['logged_in'])){
		echo "<h2>Oops!</h2><p>You need to be logged in to do that.</p>";	
		if ($die== true){
			die();
		}
	}
	//check timeout
	global $expire_time;
	if($_SESSION['expire_time']<time()){
		header("Location:inactivity.php");
		logout();
	}
	
	//add jquery timeout redirect
	if($timeout){
	?>
	<script>
	setTimeout(function(){ alert("Inactive!"); window.location = "logout.php"; }, <?php echo 60*1000*$expire_time ?>);
	</script>
	<?php
	}

}

function logout(){
	//unset all session variables
	session_unset();
	//destroy the session
	session_destroy();
}

function user_id_from_username($username){
	global $dbh;		//get database object
	$stmt = $dbh->prepare('SELECT `user_id` FROM `users` WHERE username= :username');
	$stmt->bindvalue(':username', $username);
	$stmt->execute();
	$result =$stmt->fetchall();
	return (empty($result) ? 0: $result[0]['user_id']);
	
}
function user_id_from_email($email){
	global $dbh;		//get database object
	$stmt = $dbh->prepare('SELECT `user_id` FROM `users` WHERE email= :email');
	$stmt->bindvalue(':email', $email);
	$stmt->execute();
	$result =$stmt->fetchall();
	return (empty($result) ? 0: $result[0]['user_id']);
		
}
