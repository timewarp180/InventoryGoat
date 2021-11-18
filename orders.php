<?php
	session_start();
	include('logincode.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Orders</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	  <!-- <link rel="stylesheet" href="css/Fontawesome.css"> -->
    <link rel="stylesheet" href="css/style.css">
    

</head>
<body>
    
</head>
<body>
<nav>
    <ul>
        <li class="logo">Lololong & Lucy</li>
	<li class="nav-link"><a href="home.php">Home</a></li>
        <li class="nav-link"><a href="products.php">Products</a></li>
        <li class="nav-link"><a href="neworder.php">New Order</a></li>
        <li class="nav-link"><a href="orders.php">Orders</a></li>
        <li class="nav-link"><a href="history.php">History</a></li>
        <li class="nav-link"><a href="logout.php">Logout</a></li>

        
    </ul>
</nav>

	<div class="container" style="margin-top:3%; background-color:black; border-radius:10px;">
    <div class="jumbotron" style="background-color:white;">
    	<h3>Pending Orders</h3>
    	<form class="form-inline mr-auto" method="POST">
  			<input class="form-control mr-sm-2" type="text" placeholder="Search LastName" name="searchLN" aria-label="Search">
  			<input type="submit" name="search" class="btn btn-primary" value="Search">
		</form>
    	<hr style="border: 1px solid black"></hr>
		<div class="table-responsive">
	    <table class="table table-striped">
	      <thead class="thead-dark" align="left">
			<tr>
				<td>Customer name</td>
				<td>Contact number</td>
				<td>Address</td>
				<td>Product Name</td>
				<td>Quantity</td>
				<td>Total Price</td>
				<td>Date Ordered</td>
				<td>Delivery Date</td>
				<td>Received</td>
				<td>Update</td>
				<td>Cancelled</td>
			</tr>
		</thead>
		<tbody>
		<?php
			if(isset($_POST['search'])){
				$lName = $_POST['searchLN'];

				$sql = "SELECT * FROM Orders INNER JOIN Customers ON Orders.cust_id = Customers.cust_id INNER JOIN Products ON Products.product_id = Orders.product_id WHERE cust_lname = '$lName' ";
				$res = mysqli_query($con, $sql);
				if(mysqli_num_rows($res)>0){
					while($rows=mysqli_fetch_assoc($res)){ ?>
						<tr>
							<td><?php echo $rows['cust_lname'].", ".$rows['cust_fname']; ?></td>
							<td><?php echo $rows['cust_contact_number']; ?></td>
							<td><?php echo $rows['cust_address']; ?></td>
							<td><?php echo $rows['product_name']; ?></td>
							<td><?php echo $rows['quantity_ordered']; ?></td>
							<td><?php echo "&#8369;".number_format($rows['total_price'], 2); ?></td>
							<td><?php echo $rows['date_ordered']; ?></td>
							<td><?php echo $rows['deliver_date']; ?></td>
							<td><a href="red.php?delivered=<?php echo $rows['order_id']; ?>" class="btn btn-success"><i class="fa fa-truck"></i></a></td>
							<td><a href="red.php?update=<?php echo $rows['order_id']; ?>" class="btn btn-success"><i class="fa fa-pencil-square-o"></i></a></td>
                  			<td><a href="red.php?cancel=<?php echo $rows['order_id']; ?>" class="btn btn-danger"><i class="fa fa-trash"></a></td>
						</tr>
			<?php
					}
				}else{
					echo "Last Name not on the list! ";
				}
			}else{
				$query = "SELECT * FROM Orders INNER JOIN Customers ON Orders.cust_id = Customers.cust_id INNER JOIN Products ON Products.product_id = Orders.product_id WHERE status = 'Pending' ORDER BY Orders.date_ordered ASC";
				$result = mysqli_query($con,$query);
				if(mysqli_num_rows($result)>0){
					while($row = mysqli_fetch_assoc($result)){ ?>
						<tr>
							<td><?php echo $row['cust_lname'].", ".$row['cust_fname']; ?></td>
							<td><?php echo $row['cust_contact_number']; ?></td>
							<td><?php echo $row['cust_address']; ?></td>
							<td><?php echo $row['product_name']; ?></td>
							<td><?php echo $row['quantity_ordered']." kgs."; ?></td>
							<td><?php echo "&#8369;".number_format($row['total_price'], 2); ?></td>
							<td><?php echo $row['date_ordered']; ?></td>
							<td><?php echo $row['deliver_date']; ?></td>
							<td><a href="red.php?delivered=<?php echo $row['order_id']; ?>" class="btn btn-success"><i class="fa fa-truck"></i></a></td>
							<td><a href="red.php?update=<?php echo $row['order_id']; ?>" class="btn btn-success"><i class="fa fa-pencil-square-o"></i></a></td>
                  			<td><a href="red.php?cancel=<?php echo $row['order_id']; ?>" class="btn btn-danger"><i class="fa fa-trash"></a></td>
						</tr>
			<?php		
					}
				}
			}
		?>
		</tbody>
	</table>
	</div>


	</div>
	</div>

	<!------jquery---->
<script src="js/jquery.js"></script>

<script>
    $(document).ready(function(){
        $('.btn').click(function(){
            $('.nav-link').toggleClass("show");
            $('ul li').toggleClass("hide")
        });
    });
</script>

</body>
</html>