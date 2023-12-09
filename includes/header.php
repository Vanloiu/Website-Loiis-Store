<?php 

  session_start();
  include('includes/db.php');
  include('functions/functions.php');

?>

<?php 

  if(isset($_GET['pro_id'])){

    $product_id = $_GET['pro_id'];
    $get_product_id = "select * from product where product_id = '$product_id'";
    $product = $conn->query($get_product_id)->fetch();
    $product_cat_id = $product['p_cat_id'];
    $pro_id = $product['product_id'];
    $pro_title = $product['product_title'];
    $pro_price = $product['product_price'];
    $pro_desc = $product['product_desc'];
    $pro_img1 = $product['product_img1'];
    $pro_img2 = $product['product_img2'];
    $pro_img3 = $product['product_img3'];

    $get_p_cat = "select * from product_categories where p_cat_id='$product_cat_id'";
    $row_p_cat = $conn->query($get_p_cat)->fetch();
    $p_cat_title = $row_p_cat['p_cat_title'];
    
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/bootstrap-337.min.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles/style.css"></link>
    <script src="js/scripts.js"></script>
    <title>Loiis Store</title>
</head>
<body>
 
  <div id="top"> <!-- top Begin -->
    <div class="container"> <!-- container Begin -->
      <div class="col-md-6 offer"> <!-- col-md-6 offer Begin -->
        
        <a href="" class="btn btn-success btn-sm">
          
          <?php 
          
            if(!isset($_SESSION['customer_email'])) {

              echo "Chào mừng, khách hàng!";

            } else {
              echo "Chào mừng, " . $_SESSION['customer_email'] . "";
            }

          ?>

        </a>
        <a href="checkout.php"><?php itemsInCart(); ?> Items Trong Giỏ Hàng | Tổng tiền: <?php cartTotal(); ?> </a>
     
      </div> <!-- col-md-6 offer Finish -->
      <div class="col-md-6"> <!-- col-md-6 Begin -->
        
        <ul class="menu"> <!-- menu Begin -->
          <li>
            <a href="customer_register.php">Đăng ký</a>
          </li>
          <li>
            <a href="customer/my_account.php">Tài khoản</a>
          </li>
          <li>
            <a href="cart.php">Giỏ hàng</a>
          </li>
          <li>
            <a href="checkout.php">
              
              <?php
                if(!isset($_SESSION['customer_email'])) {
                  echo "<a href='checkout.php'> Đăng nhập </a>";

                } else {
                  echo "<a href='logout.php'> Đăng xuất </a>";
                  
                }
              ?>

            </a>
          </li>
        </ul> <!-- menu Finish -->

      </div> <!-- col-md-6 Finish -->
    </div> <!-- container Finish -->
  </div> <!-- top Finish -->

  <div id="navbar" class="navbar navbar-default"> <!-- navbar navbar-default Begin -->
    <div class="container"> <!-- container Begin -->
      <div class="navbar-header"> <!-- navbar-header Begin -->
        
        <a href="index.php" class="navbar-brand home"> <!-- navbar-brand home Begin -->
          <img src="images/ecom-store-logo.png" alt="M-Dev-Store Logo" class="hidden-xs"style ="width:120%;">
          <img src="images/ecom-store-logo-mobile.png" alt="M-Dev-Store Logo Mobile" class="visible-xs" style ="width:175%;">
        </a> <!-- navbar-brand home Finish -->
        <a href="index.php" class="navbar-brand home"> <!-- navbar-brand home Begin -->
           <!--<img src="images/Logo_UEH.png" alt="Logo UEH" class="hidden-xs" style ="width:70px;">-->
         <img src="images/Logo_UEH.png" alt="Logo UEH Mobile" class="visible-xs" style ="width:50px;">
        </a>

        <button class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
          <span class="sr-only">Toggle Navigation</span>
          <i class="fa fa-align-justify"></i>
        </button>

        <button class="navbar-toggle" data-toggle="collapse" data-target="#search">
          <span class="sr-only">Toggle Search</span>
          <i class="fa fa-search"></i>
        </button>

      </div> <!-- navbar-header Finish -->
      <div class="navbar-collapse collapse" id="navigation"> <!-- navbar-collapse collapse Begin -->
        <div class="padding-nav"> <!-- padding-nav Begin -->

          <ul class="nav navbar-nav left">
            <li class="<?php if($active=='Home') echo 'active'; ?>">
              <a href="index.php">TRANG CHỦ</a>
            </li>
            <li class="<?php if($active=='Shop') echo 'active'; ?>">
              <a href="shop.php">SẢN PHẨM</a>
            </li>
            <li class="<?php if($active=='Account') echo 'active'; ?>">
              
                <?php 
                  if(!isset($_SESSION['customer_email'])) {
                    echo "<a href='checkout.php'>TÀI KHOẢN</a>";
                    
                  } else {
                    echo "<a href='customer/my_account.php?my_orders'>TÀI KHOẢN</a>";
                  }
                ?>

            </li>
            <li class="<?php if($active=='Cart') echo 'active'; ?>">
              <a href="cart.php">GIỎ HÀNG</a>
            </li>
            <li class="<?php if($active=='Contact') echo 'active'; ?>">
              <a href="contact.php">LIÊN HỆ</a>
            </li>
          </ul>

        </div> <!-- padding-nav Finish -->
        <a href="index.php" class="navbar-brand home"> <!-- navbar-brand home Begin -->
          <img src="images/Logo_UEH.png" alt="Logo UEH" class="hidden-xs" style ="width:70px;">
         <!-- <img src="images/Logo_UEH.png" alt="Logo UEH Mobile" class="visible-xs" style ="width:70px;">-->
        </a>

        <a href="cart.php" class="btn navbar-btn btn-primary right">
          <i class="fa fa-shopping-cart"></i>
          <span><?php itemsInCart(); ?> Items Trong Giỏ Hàng</span>
        </a>

        <div class="navbar-collapse collapse right"> <!-- navbar-collapse collapse right Begin -->
           
          <button class="btn btn-primary navbar-btn" type="button" data-toggle="collapse" data-target="#search">
            <span class="sr-only">Toggle Search</span>
            <i class="fa fa-search"></i>
          </button>

        </div> <!-- navbar-collapse collapse right Finish -->

        <div class="collapse clearfix" id="search"> <!-- collapse clearfix Begin -->

          <form method="get" action="results.php" class="navbar-form"> <!-- navbar-form Begin -->

            <div class="input-group"> <!--input-group Begin -->

              <input type="text" class="form-control" placeholder="Search" name="user_query" required>

              <span class="input-group-btn">
                <button type="submit" name="search" value="Search" class="btn btn-primary">
                  <i class="fa fa-search"></i>
                </button>
              </span>

            </div> <!--input-group Finish -->

          </form> <!-- navbar-form Finish -->

        </div> <!-- collapse clearfix Finish -->
      </div> <!-- navbar-collapse collapse Finish -->
    </div> <!-- container Finish -->
  </div> <!-- navbar navbar-default Finish -->

  


  <!--///////////
  <div class='col-md-4 col-sm-6 center-responsive'>
    <div class='product'>
      <a href='details.php?pro_id=$pro_id'> 
        <img class='img-responsive' src='admin_area/product_images/$pro_img1'>
      </a>
      <div class='text'>
        <h3>
          <a href='details.php?pro_id=$pro_id'> $pro_title </a>
        </h3>
        <p class='price'>
          CA$$pro_price
        </p>
        <p class='button'>
          <a class='btn btn-default' href='details.php?pro_id=$pro_id'>
            View Details
          </a>
          <a class='btn btn-primary' href='details.php?pro_id=$pro_id'>
            <i class='fa fa-shopping-cart'></i> Add to Cart
          </a>
        </p>
      </div>
    </div>
  </div>
                -->
  
