<?php 
	session_start();

	if(!isset($_SESSION['username'])){
		echo 'Log In to View This Page';
		header('location: login.php');
	}


	if(isset($_GET['logout'])){

		session_destroy();
		unset($_SESSION);
		header('location: login.php');
	}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Home Page</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<h1>Welcome <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
	<div class="container">
		<a href="home.php?logout=1" class="logout"> Log Out </a>
	</div>
</body>
</html>