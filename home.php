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
</head>
<body>
	<h1>Welcome <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
	<button> <a href="home.php?logout=1"> Log Out </a></button>
</body>
</html>