
<?php
require("mysqli_connect.php");
session_start();
if(!isset($_GET["bid"])){
    if(!$_SESSION["bid"]){
        echo "<br>Session not set!!!!<br>";
    }
  }
else{
    $_SESSION["bid"] =  $_GET["bid"];
// echo "<br>Session set<br>";

$SESSION_ID = intval($_SESSION['bid']);

if($_SERVER['REQUEST_METHOD'] =='POST'){

    // echo    $first_name = mysqli_real_escape_string($dbc,$_POST['firstname']);
    // echo   $last_name = mysqli_real_escape_string($dbc,$_POST['Lastname']);
    // echo   $Contact = mysqli_real_escape_string($dbc,$_POST['Contact']);
    // echo   $Email = mysqli_real_escape_string($dbc,$_POST['Email']);
    // echo   $Cardnumber = mysqli_real_escape_string($dbc,$_POST['Cardnumber']);
    // exit;
    // if(empty($_POST["firstname"])){
    //     echo "<span style='color:red; font-size:2em'>Please Enter First Name!!</span>";

    // } elseif (empty($_POST["Lastname"])){
    //     echo "<span style='color:red; font-size:2em'>Please Enter Last Name!!</span>";

    // }elseif(empty($_POST["Contact"])){
    //     echo "<span style='color:red; font-size:2em'>Please Enter Contact Number!!</span>";

    // }elseif(empty($_POST["Email"])){
    //     echo "<span style='color:red; font-size:2em'>Please Enter Email!!</span>";

    // }elseif(empty($_POST["Cardnumber"])){
    //     echo "<span style='color:red; font-size:2em'>Please Enter Card Number!!</span>";

    // }

    if(empty($_POST["firstname"]) || empty($_POST["Lastname"]) || empty($_POST["Contact"]) || empty($_POST["Email"]) || empty($_POST["Cardnumber"])) {

        echo "<span style='color:red; font-size:2em'>Please fill all fields!!</span>";

    }
    else{
        
         $first_name = mysqli_real_escape_string($dbc,$_POST['firstname']);
        $last_name = mysqli_real_escape_string($dbc,$_POST['Lastname']);
        $Contact = mysqli_real_escape_string($dbc,$_POST['Contact']);
        $Email = mysqli_real_escape_string($dbc,$_POST['Email']);
        $Cardnumber = mysqli_real_escape_string($dbc,$_POST['Cardnumber']);
       
            // insert customer details----------------------------------------------------

     $customer_data=" INSERT INTO `customers`(`customer_id`, `first_name`,`last_name`, `email`, `contact_number`,`card_number`)
      VALUES (null,'$first_name','$last_name','$Email','$Contact','$Cardnumber')";
      $resultcustomer_data = @mysqli_query($dbc, $customer_data) or die(mysqli_error($dbc));

      $last_id = mysqli_insert_id($dbc);
    //   echo $last_id;
    // Get book details----------------------------------------------------
    
        $Order = "SELECT * FROM bookinventory WHERE product_id = {$SESSION_ID}";
        $getorder = @mysqli_query($dbc, $Order) or die(mysqli_error($dbc));
        $rows = @mysqli_fetch_array($getorder);
        $product_id = $rows["product_id"];
        $product_name = $rows["name"];
      
    // Insert in Order Table---------------------------------------------
            $invenorderQuery = "INSERT INTO bookinventoryorder (order_id, product_id,customer_id) 
            VALUES (null,'{$product_id}','{$last_id}')";

        $order_item = @mysqli_query($dbc,$invenorderQuery)or die(mysqli_error($dbc));
        $orderedItem = @mysqli_fetch_array($order_item);

        echo "  <br><b><span style='color:green;font-size:2em'>$first_name $last_name Your Order (Book Name :- ". $product_name .") is Booked !!</span>";
    // Update Quantiy of particular item in bookinventory table-----------------
        $updateQuery = "UPDATE bookinventory SET quantity = quantity - 1 WHERE product_id= {$SESSION_ID}";
        $update_table = @mysqli_query($dbc, $updateQuery) or die(mysqli_error($dbc));

        unset ($_SESSION['bid']);
        session_destroy();

    }
}
}   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
    <form role="form" action= "checkout.php?bid=<?php echo $SESSION_ID ;?>" method="post">
        <h1>Checkout Form</h1>
        <div class="form-group row">
            <label for="inputbookname" class="col-sm-2 col-form-label">Book Name</label>
            <div class="col-sm-4">
                <?php
 $Ordernew = "SELECT * FROM bookinventory WHERE product_id = {$SESSION_ID}";
 $getordernew = @mysqli_query($dbc, $Ordernew) or die(mysqli_error($dbc));
 $rows1 = @mysqli_fetch_array($getordernew);
 $product_id1 = $rows1["product_id"];
 $product_name1 = $rows1["name"];?>
 <input disabled class="form-control" id="" name="bookname"value="<?php echo $rows1["name"];; ?>" >

               
            </div>
        </div>
        <div class="form-group row">
            <label for="inputfname" class="col-sm-2 col-form-label">First Name</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="" name="firstname" placeholder="first name">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputlname" class="col-sm-2 col-form-label">Last Name</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="" name="Lastname" placeholder="last name">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputcontact" class="col-sm-2 col-form-label">Contact</label>
            <div class="col-sm-4">
                <input type="number" class="form-control" id="" name="Contact" placeholder="Contact">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-4">
                <input type="email" class="form-control" id="" name="Email" placeholder="Email">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputcardnum" class="col-sm-2 col-form-label">Card Number</label>
            <div class="col-sm-4">
                <input type="number" class="form-control" id="" name="Cardnumber" placeholder="card number" maxlength="12">
            </div>
        </div>
        <div class="form-group row">
        <div class="offset-sm-2 col-sm-4 text-center">
          <input type="submit" value="Buy" name="submit" class="btn btn-outline-dark"/>
        </div>
      </div>
    </form>
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
            <div class="col-xs-12"> <p style="color: white">All rights reserved 2020 © Book Store<br>Gaganpreet Kaur</p>
            </div>
        </div> 
        </div> 
    </div>
</body>
</html>
