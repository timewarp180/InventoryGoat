<?php
  session_start();
  include('logincode.php');
  $error1 = '';
  $ok = '';    
?>
<html>
<head>
	<title>Products In Stock</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <style>
    /* The Modal (background) */
    .modal {
      display: none; /* Hidden by default */
      position: fixed; /* Stay in place */
      z-index: 10000; /* Sit on top */
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
    <!-- <link rel="stylesheet" href="css/Fontawesome.css"> -->
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

  <div class="container" style="margin-top:3%; background-color:black; border-radius:10px;">
    <div class="jumbotron" style="background-color:white;">
    <span style ="color:red; padding: 5px;"><?php echo $error1;?></span>
    <span style ="color:green; padding: 5px;"><?php echo $ok;?></span>
    <h3>Products In Stock</h3>
    <form class="form-inline mr-auto" method="POST">
        <input class="form-control mr-sm-2" type="text" placeholder="Search Product Name" name="searchPN" aria-label="Search">
        <input type="submit" name="Search" class="btn btn-primary" value="Search">
    </form>
    <div align="right">
      <hr style="border: 1px solid black"></hr>
      <button id="myBtn" class="btn btn-outline-success" type="button">New Product</button><br><br>
      </div>
      <div id="myModal" class="modal">

          <!-- Modal content -->
        <div class="modal-content">
            
        <span class="close" align="right">&times;</span>
        <h3 style="text-align:center;">Product Information</h3>
        <hr style="border: translucent black"></hr>
        <form method="POST" action="">
        <div class="form-group">
          <label>Product ID: </label>
          <input type="number" class="form-control" name="prodid" required><br>
          <label>Product Name: </label>
          <input type="text" class="form-control" name="name" required><br>
          <label>Description: </label>
          <input type="text" class="form-control" name="desc" required><br>
          <label>Price per kilogram: </label>
          <input type="number" class="form-control" name="price" required><br>
          <label>Stock: (KG)</label> 
          <input type="number" class="form-control" name="quantity" required><br><br>
        </div>

        <button type= "submit" name="submit" class="btn btn-primary">Add Product</button>
      </form>

      <?php 
        if(isset($_POST['submit'])){
            $id = $_POST['prodid'];
            $prodname = $_POST['name'];
            $desc = $_POST['desc'];
            $price = $_POST['price'];
            $qty = $_POST['quantity'];

            $query = "INSERT INTO Products(product_id,product_name,description,price_per_kilo,quantity) VALUES ('$id','$prodname','$desc','$price','$qty')";
            $result = mysqli_query($con,$query);
            if($result){
              $_SESSION['ok'] = "Successfully added.";
            }
        }
      ?>
      </div>
    </div>

  <div class="table-responsive" style="margin-right:20px; margin-left:20px;">
    <table class="table table-striped">
      <thead class="thead-dark">
        <tr>
          <td scope="col">Product Name</td>
          <td scope="col">Description</td>
          <td scope="col">Price per kilo</td>
          <td scope="col">In Stock</td>
        </tr>
      </thead>
      <tbody>

<?php
if(isset($_POST['Search'])){
  $prodN = $_POST['searchPN'];

  $sql = "SELECT * FROM Products WHERE product_name = '$prodN' ";
  $res1 = mysqli_query($con, $sql);
  if(mysqli_num_rows($res1)>0){
    while($row = mysqli_fetch_assoc($res1)){ ?>
      <tr>
        <td><?php echo $row['product_name']; ?></td>
        <td><?php echo $row['description']; ?></td>
        <td><?php echo $row['price_per_kilo']; ?></td>
        <td><?php echo $row['quantity']; ?></td>
        <td><a href="updateprod.php?update=<?php echo $row1['product_id']; ?>" class="btn btn-primary">Update</a>
        <a href="updateprod.php?delete=<?php echo $row1['product_id']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a></td>
      </tr>
<?php
    }
  }else{
    echo "Product Name is not found!!! ";
  }
}else{
  $query1 = "SELECT * FROM Products";
  $result1 = mysqli_query($con,$query1);
  if(mysqli_num_rows($result1)>0){
    while($row1 = mysqli_fetch_assoc($result1)){ ?>
      <tr>
        <td><?php echo $row1['product_name']; ?></td>
        <td><?php echo $row1['description']; ?></td>
        <td><?php echo $row1['price_per_kilo']; ?></td>
        <td><?php echo $row1['quantity']; ?></td>
        <td><a href="updateprod.php?update=<?php echo $row1['product_id']; ?>" class="btn btn-primary">Update</a>
        <a href="updateprod.php?delete=<?php echo $row1['product_id']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a></td>
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

    $(document).ready(function(){
        $('.btn').click(function(){
            $('.nav-link').toggleClass("show");
            $('ul li').toggleClass("hide")
        });
    });


  </script> 
</body>
</html>