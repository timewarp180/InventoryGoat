<?php
	session_start();
  include('logincode.php');

  if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    $query2 = "DELETE FROM Products WHERE product_id = '$id'";
    $result2 = mysqli_query($con,$query2);
    if($result){
      header("location: products.php");
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
	        <a class="nav-link" href="products.php">< back</a>
	      </li>
	    </ul>
	  </div>
	</nav>

	<div class="container" style="margin-top:3%; background-color:black; border-radius:10px;">
    <div class="jumbotron" style="background-color:white;">
    	<?php
    		if(isset($_GET['update'])){
    			$id = $_GET['update'];

    			$query = "SELECT * FROM Products WHERE product_id = '$id'";
    			$result = mysqli_query($con,$query);
          if($result){
            $row = mysqli_fetch_array($result);
            $name = $row['product_name'];
            $price = $row['price_per_kilo'];
            $qty = $row['quantity']; 
          }
        }
      ?>

    	<h3 style="text-align:center;">Product Information</h3>
        <hr style="border: translucent black"></hr>
        <form method="POST" action="">
        <div class="form-group">
          <input type="hidden" name="prod_id" value="<?php echo $id; ?>">
        	<label>Product Name: </label>
        	<input type="text" class="form-control" name="prodname" value="<?php echo $name;?>" required><br>
        	<label>Price per kilo: </label>
        	<input type="number" class="form-control" name="price" value="<?php echo $price;?>" required><br>
        	<label>Available stock: </label>
        	<input type="number" class="form-control" name="stock" value="<?php echo $qty;?>" required><br>
        </div>
          <button type= "submit" name="updateprod" class="btn btn-primary">Update Product</button>
    	</form>
      <?php
        if(isset($_POST['updateprod'])){
              $prodid = $_POST['prod_id'];
              $prodname = $_POST['prodname'];
              $pricee = $_POST['price'];
              $stock = $_POST['stock'];

              $query1 = "UPDATE Products SET product_name= '$prodname', price_per_kilo = '$pricee', quantity = '$stock' WHERE product_id = '$prodid'";
              $result1 = mysqli_query($con,$query1);
              if($result1){
                $_SESSION['ok'] = "Updated successfully.";
                header("location: products.php");
              }
            }
      ?>
    </div>
	</div>

</body>
</html>