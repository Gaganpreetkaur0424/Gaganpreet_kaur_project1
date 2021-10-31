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
<h1>STORE</h1>

<span><a href=index.php>home </a></span>
<span><a href=store.php>book store </a></span>
<!-- <span><a href=checkout.php>checkout </a></span> -->

<body>
    <main>
        <div class="row">

            <?php
            while ($row = mysqli_fetch_array($result)) {
            ?>
            <div class="col-md-3 single-book-in-grid">
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
                      echo "Sold out";
                  }else{
                    echo $row['quantity'];
                    ?>
                    <button> <a href='checkout.php?bid=<?php echo $row['product_id']; ?>'>
                            Add to Cart</a></button>
                    <?php   }
                  
                  ?>
                </p>

            </div>
            <?php   }
            ?>
        </div>
    </main>
    <footer class="footer-end">
        <p>
            All rights reserved 2020 © Book Store<br> Gaganpreet Kaur

        </p>
    </footer>
</body>

</html>