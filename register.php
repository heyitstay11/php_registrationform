<?php 
	session_start();

	include('connection.php');

	$username = $email = $password = $password1 = "";
	$errors = [];

	if($_POST){

		$username =  mysqli_real_escape_string($conn, $_POST['username']);	
		$email = mysqli_real_escape_string($conn, $_POST['email']);	
		$password = mysqli_real_escape_string($conn, $_POST['password']);	
		$password1 = mysqli_real_escape_string($conn, $_POST['password1']);	


		// Validation
		if(empty($username)){
			array_push($errors, 'Name is required');
		}
		if(empty($email)){
			array_push($errors, 'Email is required');
		}
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        	array_push($errors, 'Enter valid email');   
        }
		if(empty($password)){
			array_push($errors, 'Password is required');
		}
		if($password != $password1){
			array_push($errors, 'Passwords do not match');
		}

		// Check if user with same name exists
		$user_query = "SELECT * FROM user WHERE username='$username' OR email='$email' LIMIT 1 ";

		$res = mysqli_query($conn, $user_query);
		$data = mysqli_fetch_assoc($res);

		if($data){
			if($data['username'] === $username){
				array_push($errors, 'Username already Taken');
			}
			if($data['email'] === $email){
				array_push($errors, 'This email id is already registered');
			}
		}

		if(count($errors) == 0){
			// Hashing the Password
			$password = password_hash($password, PASSWORD_DEFAULT);

			// Insert Query
			$query = "INSERT INTO user(username, email, password) VALUES('$username', '$email', '$password') ";

			mysqli_query($conn, $query);
			$_SESSION['username'] = $username;
			header('location: home.php');
		}


	}
	
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
</head>
<body>
	<h2>Register</h2>

	<?php include('errors.php') ?>

	<form action="register.php" method="POST">
		<label for="username">Username</label>
		<input type="text" autocomplete="off" value="<?php echo htmlspecialchars($username); ?>" name="username">
		<label for="email">Email</label>
		<input type="email" autocomplete="off"  value="<?php echo htmlspecialchars($email); ?>" name="email">
		<label for="password">Password</label>
		<input type="password" name="password">
		<label for="password1">Confirm Password</label>
		<input type="password" name="password1">
		<button type="submit" name="submit">Submit</button>
	</form>
</body>
</html>