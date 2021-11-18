<?php
	session_start();
	include('logincode.php');

	if(isset($_GET['ret'])){
		$id = $_GET['ret'];

		$query5 = "SELECT * FROM Orders WHERE order_id = '$id'";
		$result5 = mysqli_query($con,$query5);
		if($result5){
			$ress = mysqli_fetch_array($result5);
			$stat = $ress['status'];

			$query1 = "UPDATE Orders SET status = 'Pending' WHERE order_id = '$id'";
			$result1 = mysqli_query($con,$query1);
			if($result1){
				$query3 = "SELECT * FROM Orders WHERE order_id = '$id'";
				$result3 = mysqli_query($con,$query3);
				if($result3 && $stat == 'Cancelled'){
					$rows = mysqli_fetch_array($result3);
					$prod = $rows['product_id'];
					$qty = $rows['quantity_ordered'];
					$query2 = "UPDATE Products SET quantity = quantity - '$qty' WHERE product_id = '$prod'";
					$result2 = mysqli_query($con,$query2);
				}
				$query4 = "DELETE FROM History WHERE order_id = '$id'";
				$result4 = mysqli_query($con,$query4);
				if($result4){
					header("location: history.php");
				}
			}
		}
	}
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
	  <link rel="stylesheet" href="css/Fontawesome.css">
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

<?php
	if(isset($_GET['detail'])){
		$id = $_GET['detail'];

		$query = "SELECT * FROM Orders INNER JOIN Customers ON Orders.cust_id = Customers.cust_id INNER JOIN Products ON Products.product_id = Orders.product_id WHERE Orders.order_id = '$id'";
		$result = mysqli_query($con,$query);
		if($result){
			$row = mysqli_fetch_array($result); ?>


	<div class="container" style="margin-top:3%; background-color:black; border-radius:10px;">
    <div class="jumbotron" style="background-color:white;">
 		<a class="nav-link" href="history.php"> < back</a> 


    	<h3>Order Information</h3> 
    	<hr style="border: 1px solid black"></hr>
		
    	<label>Order ID: <?php echo $row['order_id'];?></label><br>
    	<label>Customer name: <?php echo $row['cust_lname'].", ".$row['cust_fname'];?></label><br>
    	<label>Contact Number: <?php echo $row['cust_contact_number'];?></label><br>
    	<label>Address: <?php echo $row['cust_address'];?></label><br><br>
    	<label style="margin-right:20px;">Date Ordered: <?php echo $row['date_ordered'];?></label>
    	<label>Deliver Date: <?php echo $row['deliver_date'];?></label><br>
    	<label>Product Name: <?php echo $row['product_name'];?></label><br>
    	<label>Quantity: <?php echo $row['quantity']." kgs.";?></label><br>
    	<label>Total Price: <?php echo "&#8369;".number_format($row['total_price'], 2);?></label>
    </div>
	</div>

<?php 	}
	}
?>

</body>
</html>