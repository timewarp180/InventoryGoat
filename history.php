<?php
	session_start();
	include('logincode.php');
	$user = $_SESSION['login_user'];
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

	<div class="container" style="margin-top:3%; background-color:black; border-radius:10px;">
    <div class="jumbotron" style="background-color:white;">
    	<h3>Order History</h3>
    	<hr style="border: 1px solid black"></hr>
		<div class="table-responsive">
	    <table class="table table-striped">
	      <thead class="thead-dark" align="left">
			<tr>
				<td>Admin name</td>
				<td>Date Updated</td>
				<td>Customer name</td>
				<td>Date Ordered</td>
				<td>Status</td>
			</tr>
		</thead>
		<tbody>
			<?php
				$query = "SELECT * FROM History INNER JOIN Orders ON History.order_id = Orders.order_id INNER JOIN Users ON History.user_id = Users.user_id INNER JOIN Customers ON Orders.cust_id = Customers.cust_id WHERE status != 'Pending' ORDER BY history.datetime ASC";
				$result = mysqli_query($con,$query);
				if(mysqli_num_rows($result)>0){
					while($row = mysqli_fetch_assoc($result)){ ?>
						<tr>
							<td><?php echo $row['lname'].", ".$row['fname']; ?></td>
							<td><?php echo $row['datetime']; ?></td>
							<td><?php echo $row['cust_lname'].", ".$row['cust_fname']; ?></td>
							<td><?php echo $row['date_ordered']; ?></td>
							<td><?php echo $row['status']; ?></td>
							<td><a href="detail.php?detail=<?php echo $row['order_id']; ?>" class="btn btn-primary" style="margin-right:10px;">Details</a><a href="detail.php?ret=<?php echo $row['order_id']; ?>" class="btn btn-danger">Retrieve</a></td>
						</tr>
			<?php	}
				}
			?>
		</tbody>
	</table>
	</div>


	</div>
	</div>

</body>
</html>