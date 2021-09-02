<?php
	session_start();
	$_SESSION['login_user'] = '';
	include('logincode.php');
	$error = '';
	$error1 = '';
	$ok = '';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<div style="background: linear-gradient(to bottom, #cc0000 0%, #ff99cc 100%);"><img src="Logo.png" style="border-radius:5px; margin-top:20px; margin-bottom:20px; margin-left:20px;"></div>
	<nav class="navbar navbar-expand-md bg-dark navbar-dark sticky-top">
	</nav>

	<div class="container" style="margin-top:3%;">
	<div class="jumbotron" style="background: linear-gradient(to top left, #0066ff 0%, #66ffff 100%);">
		<span style ="color:red; padding: 5px;"><?php echo $error1;?></span>
		<span style ="color:green; padding: 5px;"><?php echo $ok;?></span>
		<h1>Welcome to Lucy and Lolong's Goat Store</h1>
		<hr style="border: translucent black"></hr>
		<div align="center">
		<form method="POST" action="">
			<div class="form-group">
			<label>Username: </label>
			<input type="text" name="username" class="form-control" required><br>
			<label>Password: </label>
			<input type="password" name="password" class="form-control" required><br><br>

			<button type="submit" name="submit" class="btn btn-primary">Login</button>
			<span style ="color:red; padding: 5px;"><?php echo $error;?></span>
			</div>
		</form>
		</div>
		
	</div>
	</div>

	<script>
	var modal = document.getElementById("myModal");
	var btn = document.getElementById("myBtn");
	var span = document.getElementsByClassName("close")[0];

	btn.onclick = function() {
	  modal.style.display = "block";
	}

	span.onclick = function() {
	  modal.style.display = "none";
	}

	window.onclick = function(event) {
	  if (event.target == modal) {
	    modal.style.display = "none";
	  }
	}
	</script>
</body>
</html>