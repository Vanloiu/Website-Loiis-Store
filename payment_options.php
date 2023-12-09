<div class="box">

<?php 
    
   // $session_email = $_SESSION['customer_email'];
    
   // $select_customer = "select * from customers where customer_email='$session_email'";
    
    //$run_customer = mysqli_query($con,$select_customer);
    
    //$row_customer = mysqli_fetch_array($run_customer);
    
    //$customer_id = $row_customer['customer_id'];
    
    ?>
    

  <h1 class="text-center"> Thanh Toán </h1>
  
</div>
  <p class="lead text-center">
  
    <a href="order.php?c_id= <?php echo $customer_id ?>"><form method="post">
    <input type="submit" name="submit" value="Thanh Toán">
</form></a>
  </p>
<!-- aaaa-->


<!-- aaaa-   -->
  <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        echo '<script type="text/javascript">';
        echo 'alert("Đã thanh toán thành công!");';
        echo '</script>';
    }
}
?>
<!--//////-->



  <center>
  
    <p class="lead">
      <a href="#">
        .....
        <img class="img-responsive" src="images/paypal_img.png" alt="img-paypal">
      </a>
    </p>
</center>
</div>