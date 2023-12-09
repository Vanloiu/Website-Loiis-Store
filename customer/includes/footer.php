<?php 
  include('includes/db.php');
?>

<div id="footer"> <!-- footer Begin -->
  <div class="container"> <!-- container Begin -->
    <div class="row"> <!-- row Begin -->
      <div class="col-sm-6 col-md-3"> <!-- col-sm-6 col-md-3 Begin -->

      <h4>Các Trang</h4>

        <ul>
          <li><a href="../cart.php">Giỏ Hàng</a></li>
          <li><a href="../contact.php">Liên Hệ</a></li>
          <li><a href="../shop.php">Sản Phẩm</a></li>
          <li><a href="my_account.php">Tài khoản</a></li>
        </ul>

        <hr>

        <h4>Người Dùng</h4>

        <ul>
          <?php 
            if(!isset($_SESSION['customer_email'])) {
              echo "<a href='../checkout.php'>Đăng Nhập</a>";
              
            } else {
              echo "<a href='my_account.php?my_orders'>Tài Khoản</a>";
            }
          ?>
          <li>
            <?php 
              if(!isset($_SESSION['customer_email'])) {
                echo "<a href='../checkout.php'>Đăng Nhập</a>";
                
              } else {
                echo "<a href='my_account.php?edit_account'>Thay Đổi Thông Tin</a>";
              }
            ?>
          </li>
        </ul>

        <hr class="hidden-md hidden-lg hidden-sm">

      </div> <!-- col-sm-6 col-md-3 Finish -->

      <div class="col-sm-6 col-md-3"> <!-- col-sm-6 col-md-3 Begin -->

        <h4>Top Danh Mục Sản Phẩm</h4>

        <ul>
          <?php 
          
            $get_p_cats = "select * from product_categories";

            $run_p_cats = $conn->query($get_p_cats);

            while($row_p_cats=$run_p_cats->fetch()) {

              $p_cat_id = $row_p_cats['p_cat_id'];
              $p_cat_title = $row_p_cats['p_cat_title'];

              echo "
              
                <li>
                  <a href='../shop.php?p_cat=$p_cat_id'>
                    $p_cat_title
                  </a>
                </li>
              
              ";

            }
          
          ?>
        </ul>

        <hr class="hidden-md hidden-lg">

      </div> <!-- col-sm-6 col-md-3 Finish -->

      <div class="col-sm-6 col-md-3"> <!-- col-sm-6 col-md-3 Begin -->
        <h4>Liên Hệ</h4>
        <p>
          <strong>UEH University</strong>
          <br/>279 Nguyễn Tri Phương, Phường 5, Quận 10
          <br/>TP. Hồ Chí Minh
          <br/>(+84) 37 xxxx xxx
          <br/>UEH_University@st.ueh.edu.vn
          <br/><strong>Ins @Loiis.tr</strong>
        </p>

        <a href="../contact.php">Check Our Contact Page</a>

        <hr class="hidden-md hidden-lg">

      </div> <!-- col-sm-6 col-md-3 Finish -->

      <div class="col-sm-6 col-md-3">

        <h4>Get The News</h4>

        <p class="text-muted">
          Don't miss our latest updates.
        </p>

        <form action="https://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('https://feedburner.google.com/fb/a/mailverify?uri=DiarioLondonOn', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true" method="post">
          <div class="input-group"> <!-- input-group Begin -->

            <input type="text" class="form-control" name="email">

            <input type="hidden" value="DiarioLondonOn" name="uri"/><input type="hidden" name="loc" value="en_US"/>

            <span class="input-group-btn">
              <input type="submit" value="Subscribe" class="btn btn-default">
            </span>

          </div> <!-- input-group Finish -->
        </form>

        <hr>

        <h4>Keep In Touch</h4>

        <p class="social">
          <a href="../#" class="fa fa-facebook"></a>
          <a href="../#" class="fa fa-twitter"></a>
          <a href="../#" class="fa fa-instagram"></a>
          <a href="../#" class="fa fa-google-plus"></a>
          <a href="../#" class="fa fa-envelope"></a>
        </p>

      </div>

    </div> <!-- row Finish -->
  </div> <!-- container Finish -->
</div> <!-- footer Finish -->

<div id="copyright"> <!-- #copyright Begin -->
  <div class="container"> <!-- container Begin -->

    <div class="col-md-6"> <!-- "col-md-6 Begin -->

      <p class="pull-left">&copy; 2023 Loiis Store All Rights Reserved</p>

    </div> <!-- "col-md-6 Finish -->
    
    <div class="col-md-6"> <!-- "col-md-6 Begin -->

      <p class="pull-right">
        Theme by: <a href="#">@Loiis.tr</a>
      </p>
    
    </div> <!-- "col-md-6 Finish -->

  </div> <!-- container Finish -->
</div> <!-- #copyright Finish -->