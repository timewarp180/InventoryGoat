<?php
	session_start();
	include('logincode.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Update Orders</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<div style="background: linear-gradient(to bottom, #cc0000 0%, #ff99cc 100%);">
		<img src="Logo.png" style="border-radius:5px; margin-top:20px; margin-bottom:20px; margin-left:20px;">
	</div>
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

	<div class="container"  style="margin-top:3%;">
	<div class="jumbotron" style="background: linear-gradient(to right, #ff6666 53%, #ffffff 100%);">
		<a href="orders.php">< back to Orders</a>
		<form method="POST">
			<label>Order ID: </label>
			<input type="number" name="order"><br>
			<button type="submit" name="submit">Update</button>
		</form>
	</div>
	</div>
</body>
</html>