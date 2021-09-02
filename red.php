<?php
	session_start();
	include('logincode.php');
	$use = $_SESSION['login_user'];
	$_SESSION['error'] = '';

	if(isset($_GET['cancel'])){
		$id = $_GET['cancel'];

		$query1 = "UPDATE Orders SET status = 'Cancelled' WHERE order_id = '$id'";
		$result2 = mysqli_query($con,$query1);
		if($result2){
			$query4 = "SELECT * FROM Orders WHERE order_id = '$id'";
			$result4 = mysqli_query($con,$query4);
			if($result4){
				$fetch = mysqli_fetch_array($result4);
				$qty = $fetch['quantity_ordered'];
				$prod = $fetch['product_id'];

				$query5 = "UPDATE Products SET quantity = quantity + '$qty' WHERE product_id = '$prod'";
				$result5 = mysqli_query($con,$query5);
				if($result5){

					$query3 = "INSERT INTO History(order_id,user_id,datetime) VALUES ('$id','$use',NOW())";
					$result3 = mysqli_query($con,$query3);

					if($result3){
						header("location: orders.php");
					}
				}
			}
		}
	}

	if(isset($_GET['delivered'])){
		$id = $_GET['delivered'];

		$sql = "UPDATE Orders SET status = 'Delivered' WHERE order_id = '$id'";
		$res = mysqli_query($con,$sql);
		if($res){
			$sql1 = "INSERT INTO History(order_id,user_id,datetime) VALUES ('$id','$use',NOW())";
			$res1 = mysqli_query($con,$sql1);
			if($res1){
				header("location: orders.php");
			}
		}
	}

	if(isset($_GET['update'])){
		$id = $_GET['update'];

		$sql2 = "SELECT * FROM Orders INNER JOIN Customers ON Orders.cust_id = Customers.cust_id INNER JOIN Products ON Products.product_id = Orders.product_id WHERE order_id = '$id'";
		$res2 = mysqli_query($con,$sql2);
		if($res2){
			$row = mysqli_fetch_array($res2);
			$custNameL = $row['cust_lname'];
			$custNameF = $row['cust_fname'];
			$custNum = $row['cust_contact_number'];
			$custAdd = $row['cust_address'];
			$prodName = $row['product_name'];
			$prodID = $row['product_id'];
			$qty = $row['quantity_ordered'];
			$dateOrdered = $row['date_ordered'];
			$dateDelivered = $row['deliver_date'];

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
	        <a class="nav-link" href="orders.php">< back</a>
	      </li>
	    </ul>
	  </div>
	</nav>

<?php
	if(isset($_POST['updateorder'])){
		$orderID = $_POST['order_id'];
		$custL = $_POST['custNameL'];
		$custF = $_POST['custNameF'];
		$custnum = $_POST['custNum'];
		$add = $_POST['custAdd'];
		$prodN = $_POST['prodName'];
		$q = $_POST['qty'];
		$DO = $_POST['dateOrdered'];
		$DD = $_POST['dateDelivered'];
		$pastprod = $_POST['pastprod_id'];
		$pastq = $_POST['pastq_id'];

		$sql3 = "SELECT * FROM Products WHERE product_id = '$prodN'";
		$res3 = mysqli_query($con,$sql3);

		if($res3){
			$row1 = mysqli_fetch_array($res3);
			$price = $row1['price_per_kilo'];

			$sql33 = "UPDATE Products SET quantity = quantity - '$q' WHERE product_id = '$prodN'";
			$res33 = mysqli_query($con,$sql33);

			if($res33){
				$sql331 = "UPDATE Products SET quantity = quantity + '$pastq' WHERE product_id = '$pastprod'";
				$res331 = mysqli_query($con,$sql331); 

				$sql4 = "SELECT cust_id FROM Customers WHERE cust_lname = '$custL' AND cust_fname = '$custF' AND cust_contact_number = '$custnum' ";
				$res4 = mysqli_query($con, $sql4);

				if($res4){
					if(mysqli_num_rows($res4)>0){
						$row2  = mysqli_fetch_array($res4);
						$custID = $row2['cust_id'];

						$UD = "UPDATE Orders SET cust_id = '$custID', product_id = '$prodN', quantity_ordered = '$q', date_ordered = '$DO', deliver_date = '$DD', total_price = $q*$price WHERE order_id = '$orderID' ";
						$res5 = mysqli_query($con,$UD);

						if($res5){
							$_SESSION['ok'] = "Order successfully updated.";
							header("location: orders.php");
						}else{
							$_SESSION['error'] = "Order not updated.";
						}
					}else{
						$_SESSION['error'] = "Customer not found.";
					}
					
				}

			}
				
		}

	}
	
?>

	<div class="container" style="margin-top:3%; background-color:black; border-radius:10px;">
    <div class="jumbotron" style="background-color:white;">

   <span style = "color:#a84032;"><?php echo $_SESSION['error'];?></span>
    <h3 style="text-align:center;">Order Information</h3>
        <hr style="border: translucent black"></hr>
        <form method="POST" action="">
        <div class="form-group">
          <input type="hidden" name="order_id" value="<?php echo $id; ?>">
           <input type="hidden" name="pastprod_id" value="<?php echo $prodID; ?>">
            <input type="hidden" name="pastq_id" value="<?php echo $qty; ?>">
        	<label>Customer Last Name: </label>
        	<input type="text" class="form-control" name="custNameL" value="<?php echo $custNameL;?>" required><br>
        	<label>Customer First Name: </label>
        	<input type="text" class="form-control" name="custNameF" value="<?php echo $custNameF;?>" required><br>
        	<label>Customer Number: </label>
        	<input type="number" class="form-control" name="custNum" value="<?php echo $custNum;?>" required><br>
        	<label>Address: </label>
        	<input type="text" class="form-control" name="custAdd" value="<?php echo $custAdd;?>" required><br>
        	<label>Product Name: </label>
        		<select class="form-control" name="prodName">
        			<option value="<?php echo $prodID;?>"><?php echo $prodName;?></option>
        			<?php
        				$sql = "SELECT * FROM Products WHERE product_id != '$prodID'";
						$results = mysqli_query($con,$sql);
						if(mysqli_num_rows($results) > 0){
							while($sql1 = mysqli_fetch_assoc($results)){ ?>
								<option value="<?php echo $sql1['product_id'];?>"><?php echo $sql1['product_name'];?></option>
					<?php	}
						}
        			?>

        		</select><br>

        	<label>Quantity: </label>
        	<input type="number" class="form-control" name="qty" value="<?php echo $qty;?>" required><br>
        	<label>Date Ordered: </label>
        	<input type="date" class="form-control" name="dateOrdered" value="<?php echo $dateOrdered;?>" required><br>
        	<label>Delivery Date: </label>
        	<input type="date" class="form-control" name="dateDelivered" value="<?php echo $dateDelivered;?>" required><br>
        	
        	<button type= "submit" name="check" class="btn btn-primary">Check Price</button>
        	<?php
        	if(isset($_POST['check'])){
        		$prodNamee = $_POST['prodName'];
        		$qtyy = $_POST['qty'];
        		$sql1 = "SELECT * FROM Products WHERE product_id = '$prodNamee'";
				$results1 = mysqli_query($con,$sql1);
				if($results1){
					$rowss = mysqli_fetch_array($results1);
					$total = $rowss['price_per_kilo'] * $qtyy; ?>

			<span style="text-color: red;"><?php echo"&#8369;".number_format($total, 2);?></span>

			<?php	}

        	}
        	?>
        	
        </div>
          <button type= "submit" name="updateorder" class="btn btn-primary">Update Order</button>
    	</form>
    	 </div>
	</div>

</body>
</html>


