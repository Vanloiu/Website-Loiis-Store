<?php 

  $active = 'Account';
  include('views/header.php');
  include('models/db.php');

?>

<div id="content"> <!-- content Begin -->
  <div class="container"> <!--container Begin -->
    <div class="col-md-12"> <!-- col-md-12 Begin -->

      <ul class="breadcrumb">
        <li>
          <a href="ndex.php">Trang chủ</a>
        </li>
        <li>
          Đăng nhập
        </li>
      </ul>

    </div> <!-- col-md-12 Finish -->

    <div class="col-md-3"> <!-- col-md-3 Begin -->
      
      <?php 
        include('views/sidebar.php');
      ?>

    </div> <!-- col-md-3 Finish -->
    <div class="col-md-9">

      <?php 
      
        if(!isset($_SESSION['customer_email'])) {

          include('customer/customer_login.php');

        } else {

          include('controllers/payment_options.php');

        }

      ?>

    </div>
  </div> <!--container Finish -->
</div> <!-- content Finish -->

<?php 

  include('views/footer.php');

?>

<script src="js/jquery-331.min.js"></script>
<script src="js/bootstrap-337.min.js"></script>
</body>
</html>