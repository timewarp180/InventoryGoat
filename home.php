<?php
	session_start();
	include('logincode.php');
	// $_SESSION['login_user']= "";
	$us = $_SESSION['lname'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>HomePage</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  	<style>
		/* The Modal (background) */
		.modal {
		  display: none; /* Hidden by default */
		  position: fixed; /* Stay in place */
		  z-index: 1; /* Sit on top */
		  padding-top: 100px; /* Location of the box */
		  left: 0;
		  top: 0;
		  width: 100%; /* Full width */
		  height: 100%; /* Full height */
		  overflow: auto; /* Enable scroll if needed */
		  background-color: rgb(0,0,0); /* Fallback color */
		  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
		}

		/* Modal Content */
		.modal-content {
		  background-color: #fefefe;
		  margin: auto;
		  padding: 20px;
		  border: 1px solid #888;
		  width: 80%;
		}

		/* The Close Button */
		.close {
		  color: #aaaaaa;
		  font-size: 28px;
		  font-weight: bold;
		}

		.close:hover,
		.close:focus {
		  color: #000;
		  text-decoration: none;
		  cursor: pointer;
		}
	</style>
</head>
<body>
	<div style="background: linear-gradient(to bottom, #cc0000 0%, #ff99cc 100%);"><img src="Logo.png" style="border-radius:5px; margin-top:20px; margin-bottom:20px; margin-left:20px;"></div>
	<nav class="navbar navbar-expand-md bg-dark navbar-dark sticky-top">
  		<!-- Brand -->
	  	<a class="navbar-brand" href="home.php">
	  		<img src="logo.png" alt="Logo" style="width:40px; border-radius:40px;">
	  	</a>

		  <!-- Toggler/collapsibe Button -->
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
		    <span class="navbar-toggler-icon"></span>
		  </button>

	  <!-- Navbar links -->
	  <div class="collapse navbar-collapse" id="collapsibleNavbar">
	    <ul class="navbar-nav">
	      <li class="nav-item">
	        <a class="nav-link" href="products.php">Products</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="neworder.php">New Order</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="orders.php">Orders</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="history.php">History</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="logout.php">Logout</a>
	      </li>
	    </ul>
	  </div>
	</nav>

	<?php
		if(isset($_POST['register'])){
			$userid = $_POST['userid'];
			$id = $_POST['user'];
			$pass = $_POST['pass'];
			$lname = $_POST['lname'];
			$fname = $_POST['fname'];
			$middle = $_POST['middle'];
			$email = $_POST['email'];
			$contact = $_POST['contact'];

			$query4 = "INSERT INTO Users(user_id,username,password,lname,fname,middle,email,contact_number) VALUES ('$userid','$id','$pass','$lname','$fname','$middle','$email','$contact')";
			$result4 = mysqli_query($con,$query4);
			if(!$result4){
				$error1 = "User already exists.";
			}else{
				$ok = "Registered Successfully.";
			}
		}
	?>

	<div class="container" style="margin-top:3%; background-color:black; border-radius:10px;">
    <div class="jumbotron" style="background-color:white;">
    	<h3>Welcome Admin <?php echo $us;?> !</h3><br>
		<div>
			<label>Register New Admin? </label>
			<button id="myBtn" class="btn btn-outline-success" type="button">Register</button>
		</div>
		<hr style="border: 1px solid black"></hr>

		<div id="myModal" class="modal">

			  <!-- Modal content -->
			  <div class="modal-content">
			  	
			    <span class="close" align="right">&times;</span>
			    <h3 style="text-align:center;">Register</h3>
				<hr style="border: translucent black"></hr>
				<div align="left">
				<form method="POST" action="">
					<div class="form-group">
					<label>User ID: </label>
					<input type="number" name="userid" class="form-control" placeholder="Enter employee ID" required>
					<label>Username: </label>
					<input type="text" name="user" class="form-control" placeholder="Enter username" required>
					<label>Password: </label>
					<input type="password" name="pass" class="form-control" placeholder="Enter password" required>
					<label>Last Name: </label>
					<input type="text" name="lname" class="form-control" placeholder="Enter last name" required>
					<label>First Name: </label>
					<input type="text" name="fname" class="form-control" placeholder="Enter first name" required>
					<label>Middle Initial: </label>
					<input type="text" name="middle" class="form-control" placeholder="Enter middle initial" required>
					<label>Email: </label>
					<input type="email" name="email" class="form-control" placeholder="Enter email" required>
					<label>Contact Number: </label>
					<input type="number" name="contact" class="form-control" placeholder="Enter contact number" required>
					<br><br></div>

					<input type="submit" name="register" class="btn btn-primary" value="Register"><br><br>
				</form>
				</div>
		</div>
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