<?php
	session_start();
	include('logincode.php');
	$error1 = '';
	$ok = '';
?>
<!DOCTYPE html>
<html>
<head>
	<title>New Order</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

  	<style type="text/css">
  	</style>
    <link rel="stylesheet" href="css/Fontawesome.css">
    <link rel="stylesheet" href="css/style.css">
    

</head>
<body>
    
</head>
<body>
<nav>
    <ul>
        <li class="logo">Lolong & Lucy</li>
	<li class="nav-link"><a href="home.php">Home</a></li>
        <li class="nav-link"><a href="products.php">Products</a></li>
        <li class="nav-link"><a href="neworder.php">New Order</a></li>
        <li class="nav-link"><a href="orders.php">Orders</a></li>
        <li class="nav-link"><a href="history.php">History</a></li>
        <li class="nav-link"><a href="logout.php">Logout</a></li>

        
    </ul>
</nav>

		<?php
			if(isset($_POST['submit'])){
				$custl = $_POST['lname'];
				$custf = $_POST['fname'];
				$email = $_POST['email'];
				$contact = $_POST['contact'];
				$address = $_POST['address'];

				$productN = $_POST['prodname'];
				$qty = $_POST['qty'];
				$dateor = $_POST['dateor'];
				$datedel = $_POST['datedel'];

				$query1 = "SELECT * FROM Products WHERE product_id = '$productN'";
				$result1 = mysqli_query($con,$query1);
				if(mysqli_num_rows($result1)>0){
					while($row = mysqli_fetch_assoc($result1)){
						$prodid = $row['product_id'];
						$prodn = $row['product_name'];
						$price = $row['price_per_kilo'];
						$stock = $row['quantity'];
					}
				}
				if($qty <= $stock){
					$query2 = "SELECT cust_id FROM Customers WHERE cust_lname = '$custl' AND cust_fname = '$custf'";
					$result2 = mysqli_query($con,$query2);
					if(mysqli_num_rows($result2) == 0){
						$query = "INSERT INTO Customers(cust_lname,cust_fname,cust_email,cust_contact_number,cust_address) VALUES ('$custl','$custf','$email','$contact','$address')";
						$result = mysqli_query($con,$query);
					}

					$query6 = "SELECT cust_id FROM Customers WHERE cust_lname = '$custl' AND cust_fname = '$custf'";
					$result6 = mysqli_query($con,$query6);
					if(mysqli_num_rows($result6)>0){
						$row1 = mysqli_fetch_array($result6);
						$custid = $row1['cust_id'];
					}

					$total = $price * $qty;

					$query3 = "INSERT INTO Orders(cust_id,product_id,quantity_ordered,total_price,date_ordered,deliver_date,status) 
								VALUES ('$custid','$prodid','$qty','$total','$dateor','$datedel','Pending')";
					$result3 = mysqli_query($con,$query3);

					$query4 = "UPDATE Products SET quantity = '$stock' - '$qty' WHERE product_id = '$prodid'";
					$result4 = mysqli_query($con,$query4);
					if($result4){
						$ok = "Order added successfully.";
					}

				}else{
					$error1 = "Insufficient stock of ".$prodn."<br> In Stock: ".$stock." kilograms";
				}	
			}
		?>

	<div class="container" style="margin-top:3%; background-color:black; border-radius:10px;">
    <div class="jumbotron" style="background-color:white;">
    <span style ="color:red;"><?php echo $error1;?></span>
    <span style ="color:green; padding: 5px;"><?php echo $ok;?></span>
		<form method="POST" action="">
			<div class="form-group">
			<h4>Customer Information</h4>
			<hr style="border: translucent black"></hr>
			<label>Customer Lastname: </label>
			<input type="text" name="lname" class="form-control" required><br>
			<label>Customer Firstname: </label>
			<input type="text" name="fname" class="form-control" required><br>
			<label>Email: </label>
			<input type="email" name="email" class="form-control"><br>
			<label>Contact Number: </label>
			<input type="text" name="contact" class="form-control" required><br>
			<label>Customer Address: </label>
			<input type="text" name="address" class="form-control" required><br><br>

			<h4>New Order Information</h4>
			<hr style="border: translucent black"></hr>
			<label>Product name: </label>
				<select class="form-control" name="prodname">
		<?php
			$sql = "SELECT * FROM Products";
			$results = mysqli_query($con,$sql);
			if(mysqli_num_rows($results) > 0){
				while($sql1 = mysqli_fetch_assoc($results)){ ?>
					<option value="<?php echo $sql1['product_id']?>"><?php echo $sql1['product_name']?></option>
		<?php	}
			}
		?>
			</select><br>
			<label>Quantity: (KG)</label>
			<input type="number" name="qty" class="form-control"><br>
			<label>Date Ordered: </label>
			<input type="date" name="dateor" class="form-control"><br>
			<label>Deliver Date: </label>
			<input type="date" name="datedel" class="form-control"><br>

			<button type= "submit" name="submit" class="btn btn-primary">Add Order</button></div>
		</form>
		
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