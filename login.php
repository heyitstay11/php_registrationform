<?php 
	session_start();

	include('connection.php');

	$username = $password  = "";
	$errors = [];

	if($_POST){

		$username =  mysqli_real_escape_string($conn, $_POST['username']);	
		$password = mysqli_real_escape_string($conn, $_POST['password']);


		// Validation
		if(empty($username)){
			array_push($errors, 'Username is required');
		}
		if(empty($password)){
			array_push($errors, 'Password is required');
		}


		if(count($errors) == 0){
			// Verify User Query
			$query = "SELECT * FROM user WHERE username='$username' ";

			$results = mysqli_query($conn, $query);
		
			if(mysqli_num_rows($results)){
				$user = mysqli_fetch_assoc($results);
				$hashed_password = $user['password'];
				if(password_verify($password, $hashed_password)){
					$_SESSION['username'] = $username;
					header('location: home.php');
				}else{
					array_push($errors, "Wrong Password, Please try again");
				}
			}else{
				array_push($errors, "No user with this username, Please try again");
			}

		}


	}
	
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<h2>Login</h2>

	<?php include('errors.php') ?>

<div class="form-container">
	<form action="login.php" method="POST">
		<label for="username">Username</label>
		<input type="text" placeholder="Eg: John123" autocomplete="off" value="<?php echo htmlspecialchars($username); ?>" name="username">
		<label for="password">Password</label>
		<input type="password" name="password">
		<button type="submit" name="submit">Login</button>
		<div class="button-container">
		<p>Not a User  <a href="register.php">Register</a> </p>			
		</div>
	</form>
</div>

</body>
</html>