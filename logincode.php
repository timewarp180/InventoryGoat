<?php
	include('connect.php');
	$error=''; // Variable To Store Error Message
	if (isset($_POST['submit'])) {
		if (empty($_POST['username']) || empty($_POST['password'])) {
			$error = "Username or Password is invalid";
		}else{
			$username = $_POST['username'];
			$password = $_POST['password'];

			$query = "SELECT * FROM Users WHERE user_id = '$username' AND password = '$password'";
			$result = mysqli_query($con,$query);
			$rows = mysqli_num_rows($result);
			$row = mysqli_fetch_assoc($result);
			if($rows == 1){
				$_SESSION['login_user'] = $username;
				header("location: home.php");
			}else{
				$error = "Username or Password is invalid.";
			}
			mysqli_close($con);
		}
	}


?>