<?php 

  $active = 'Cart';
  include('views/header.php');

?>

  <div id="content"> <!-- content Begin -->
    <div class="container"> <!--container Begin -->
      <div class="col-md-12"> <!-- col-md-12 Begin -->

        <ul class="breadcrumb">
          <li>
            <a href="index.php">Trang chủ</a>
          </li>
          <li>
            Giỏ hàng
          </li>
        </ul>

      </div> <!-- col-md-12 Finish -->
      
      <div id="cart" class="col-md-9">
        <div class="box">
          <form action="cart.php" method="post" enctype="multipart/form-data">
            <h1>Danh sách Giỏ hàng</h1>

            <!-- 
            < ?php
            
              $ip_add = real_ip();
              $connect_cart = "select count(*) from cart where ip_add = '$ip_add'";
              $run_cart = $conn->query($connect_cart);
              $count = $run_cart->fetchColumn();
            
            ?>
            -->

            <p class="text-muted">Hiện tại, bạn có <?php itemsInCart(); ?> items trong giỏ hàng</p>

            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th colspan="2">Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Size</th>
                    <th colspan="1">Loại bỏ</th>
                    <th colspan="2">Giá</th>
                  </tr>
                </thead>
                <tbody>

                  <?php 

                    $ip_add = real_ip();
                    $connect_cart = "select * from cart where ip_add = '$ip_add'";
                    $run_cart = $conn->query($connect_cart);
                    $total = 0;

                    while($row_cart = $run_cart->fetch()) {

                      $pro_id = $row_cart['p_id'];
                      $pro_size = $row_cart['size'];
                      $pro_qty = $row_cart['qty'];

                      $get_products = "select * from product where product_id = '$pro_id'";
                      $run_products = $conn->query($get_products);

                      while($row_products=$run_products->fetch()) {

                        $product_title = $row_products['product_title'];
                        $product_price = $row_products['product_price'];
                        $product_img1 = $row_products['product_img1'];
                        $item_price = $row_products['product_price'];
                        $subtotal = $row_products['product_price'] * $pro_qty;
                        $total += $subtotal;

                  ?>
                  <tr>
                    <td>
                      <img class="img-responsive" src="admin_area/product_images/<?php echo $product_img1; ?>" alt="Product-1b">
                    </td>
                    <td>
                      <a href="details.php?pro_id=<?php echo $pro_id; ?>"><?php echo $product_title; ?></a>
                    </td>
                    <td>
                      <?php echo $pro_qty; ?>
                    </td>
                    <td>
                      <?php echo $item_price; ?>.000 đ
                    </td>
                    <td>
                      <?php echo $pro_size; ?>
                    </td>
                    <td>
                      <input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?>">
                    </td>
                    <td>
                       <?php echo $subtotal; ?>.000 đ
                    </td>
                  </tr>

                  <?php 
                  
                      }
                    }
                  
                  ?>

                </tbody>

                <tfoot>
                  <tr>
                    <th colspan="5">Tổng cộng</th>
                    <th colspan="2">GIÁ <?php echo $total; ?> .000 Đ</th>
                  </tr>
                </tfoot>
                
              </table>
            </div>

            <div class="box-footer">
              <div class="pull-left">
                <a href="index.php" class="btn btn-default">
                  <i class="fa fa-chevron-left"></i> Tiếp Tục Shopping
                </a>
              </div>
              <div class="pull-right">
                <button type="submit" name="update" value="Update Cart" class="btn btn-default">
                  <i class="fa fa-refresh"></i> Update Giỏ Hàng
                </button>

                <a href="checkout.php" class="btn btn-primary">
                  Thanh Toán  <i class="fa fa-chevron-right"></i>
                </a>

              </div>
            </div>

          </form>
        </div>

        <?php 
          
          echo $update_cart = removeFromCart();
        
        ?>

        <div id="row same-height-row">

          <div class="col-md-3 col-sm-6">
            <div class="box same-height headline">
              <h3 class="text-center">Các Sản Phẩm Khác</h3>
            </div>
          </div>

          <?php randomProducts(3); ?>
          

        </div>
      </div>

      <div class="col-md-3">
        <div id="order-summary" class="box">
          <div class="box-header">
            <h3>Thống kê Chi phí</h3>
          </div>
          <p class="text-muted">
          Chi phí vận chuyển và bổ sung được tính toán dựa trên giá trị bạn đã nhập.
          </p>
          <div class="table-responsive">
            <table class="table">
              <tbody>
                <tr>
                  <td> Total </td>
                  <th>  <?php echo $total; ?> Đ</th>
                </tr>
                <tr>
                  <td>Phí Vận chuyển</td>
                  <th>0 Đ</th>
                </tr>
                <tr>
                  <td>Thuế</td>
                  <th>0 Đ</th>
                </tr>
                <tr class="total">
                  <td>Tổng cộng </td>
                  <th><?php echo $total; ?>.000 Đ</th>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
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