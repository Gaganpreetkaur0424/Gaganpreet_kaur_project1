<?php
require('mysqli_connect.php');
session_start();
$query = "SELECT * FROM bookinventory";
$result = @mysqli_query($dbc, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Book Store</title>
</head>

<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">Gaganpreet's Bookstore</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav ml-auto">
      <a class="nav-item nav-link" href=index.php>Home</a>
      <a class="nav-item nav-link" href=store.php>Book Store</a>
      <!-- <a class="nav-item nav-link" href=checkout.php>Checkout</a> -->
    </div>
  </div>
</nav>

<body>
    <main>
<div class="container">
        <div class="row">

            <?php
            while ($row = mysqli_fetch_array($result)) {
            ?>
            <div class="col-md-4 single-book-in-grid">
<div class="padding">
                <img src='uploads/<?php echo $row['image']; ?>' width="100" height="100">
                <h3>
                    Book Name: <?php echo $row['name']; ?>
                </h3>
                <p>
                    Description: <?php echo $row['detail']; ?>
                </p>
                Price: <p> <?php echo $row['price']; ?></p>
                Quantiy: <p><?php 
                  if($row['quantity'] == 0){
                    echo "<span style='color:red; font-size:1em'>Sold Out!!</span>";
                  }else{
                    echo $row['quantity'];
                    ?>
                    <button type="button" class="btn btn-outline-dark"> <a href='checkout.php?bid=<?php echo $row['product_id']; ?>'>
                            Add to Cart</a></button>
                    <?php   }
                  
                  ?>
                </p>
</div>
            </div>
            <?php   }
            ?>
        </div>
</div>
    </main>
    <footer class="footer-end background">
        <div class="container">
    <div class="row">
        <div class="col-md-3">
            <h3>About Book Store</h3>
            <p>Read what you want, when you want…!</p>
        </div>
        <div class="col-md-3">
            <h3>Learn more</h3>
                <a class="nav-item nav-link anchor" href=index.php>Home</a>
                <a class="nav-item nav-link anchor" href=store.php>Book Store</a>
                <!-- <a class="nav-item nav-link anchor" href=checkout.php>Checkout</a> -->
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
    </div>
</div>
</footer>
<div class="outer-footer">
<div class="container">
        <div class="row">
            <div class="col-xs-12"> <p style="color: white">All rights reserved 2020 © Book Store<br> Gaganpreet Kaur</p>
            </div>
        </div> 
        </div> 
    </div>
</body>

</html>