<?php 

  $active = 'Account';
  include('includes/header.php');
  include('includes/db.php');

?>

  <div id="content"> <!-- content Begin -->
    <div class="container"> <!--container Begin -->
      <div class="col-md-12"> <!-- col-md-12 Begin -->

        <ul class="breadcrumb">
          <li>
            <a href="index.php">Trang chủ</a>
          </li>
          <li>
            Đăng ký
          </li>
        </ul>

      </div> <!-- col-md-12 Finish -->

      <div class="col-md-3"> <!-- col-md-3 Begin -->

        <?php 
          include('includes/sidebar.php');
        ?>

      </div> <!-- col-md-3 Finish -->

      <div class="col-md-9"> <!-- col-md-9 Begin -->
        <div class="box"> <!-- box Begin -->
          <div class="box-header"> <!-- box-header Begin -->
            <div class="center-all"> <!-- center-all Begin -->
              <h3>Hãy nhập đầy đủ thông tin để Đăng ký tài khoản mới </h3>
            </div> <!-- center-all Finish -->

            <form action="customer_register.php" method="post" enctype="multipart/form-data">

              <div class="form-group"> <!-- form-group Begin -->
                <label>Họ và tên</label>
                <input type="text" class="form-control" name="c_name" required>
              </div> <!-- form-group Finish -->

              <div class="form-group"> <!-- form-group Begin -->
                <label>Địa chỉ Email</label>
                <input type="text" class="form-control" name="c_email" required>
              </div> <!-- form-group Finish -->

              <div class="form-group"> <!-- form-group Begin -->
                <label>Mật khẩu</label>
                <input type="password" class="form-control" name="c_pass" required>
              </div> 
              
              <div class="form-group"> <!-- form-group Begin -->
                <label>Nhập lại Mật khẩu</label>
                <input type="password" class="form-control" name="c_passs" required>
              </div><!-- form-group Finish -->

             <!-- <div class="form-group"> form-group Begin
                <label>Đia chỉ</label>
                <input type="text" class="form-control" name="c_country" required>
              </div>  form-group Finish -->

              <!--<div class="form-group">  form-group Begin
                <label>Your City</label>
                <input type="text" class="form-control" name="c_city" required>
              </div> form-group Finish -->

              <div class="form-group"> <!--form-group Begin -->
                <label>Số điện thoại</label>
                <input type="text" class="form-control" name="c_contact" required>
              </div> <!--form-group Finish -->

            <div class="form-group"> 
                <label>Địa chỉ</label>
                <input type="text" class="form-control" name="c_address" required>
              </div>

              <div class="form-group"> <!-- form-group Begin -->
                <label>Ảnh đại diện</label>
                <input type="file" class="form-control form-height-custom" name="c_image" required>
              </div> <!-- form-group Finish -->

              <div class="text-center">
                <button type="submit" name="register" class="btn btn-primary">
                  <i class="fa fa-user"></i> Hoàn tất Đăng ký
                </button>
              </div>

            </form>

          </div> <!-- box-header Finish -->
        </div> <!-- box Finish -->
      </div> <!-- col-md-9 Finish -->

    </div> <!--container Finish -->
  </div> <!-- content Finish -->

  <?php 
  
    include('includes/footer.php');

  ?>

  <script src="js/jquery-331.min.js"></script>
  <script src="js/bootstrap-337.min.js"></script>
</body>
</html>

<?php 

  if(isset($_POST['register'])) {

    $customer_name = $_POST['c_name'];
    $customer_email = $_POST['c_email'];
    $customer_password = $_POST['c_pass'];
    $customer_country = $_POST['c_country'];
    $customer_city = $_POST['c_city'];
    $customer_contact = $_POST['c_contact'];
    $customer_address = $_POST['c_address'];
    $customer_image_name = $_FILES['c_image']['name'];
    $customer_tmp = $_FILES['c_image']['tmp_name'];
    $path = "customer/customer_images/";
    $customer_ip = real_ip();

    // Đảm bảo an toàn khi tải tệp lên
    $uploaded_file = validate_img_security($customer_image_name, $customer_tmp, $path);
     // Đã xóa 2 địa chỉ customer_city and country
    $insert_customer = "insert into customers (customer_name, customer_email, customer_pass, customer_contact, customer_address, customer_image, customer_ip) values (?,?,?,?,?,?,?)";

    $conn->prepare($insert_customer)->execute([$customer_name,$customer_email,$customer_password, $customer_contact, $customer_address, $customer_image_name, $customer_ip]);

    // Chèn vào giỏ hàng
    $select_cart = "select count(*) from cart where ip_add = '$customer_ip'";
    $run_cart = $conn->query($select_cart)->fetchColumn();

    if($run_cart > 0) {

      $_SESSION['customer_email'] = $customer_email;
      echo "<script>alert('Bạn đã đăng ký tài khoản thành công!')</script>";
      echo "<script>window.open('checkout.php','_self')</script>";

    } else {

      $_SESSION['customer_email'] = $customer_email;
      echo "<script>alert('Bạn đã đăng ký tài khoản thành công!')</script>";
      echo "<script>window.open('index.php','_self')</script>";

    }

  }

?>