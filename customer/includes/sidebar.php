<div class="panel panel-default sidebar-menu"><!-- panel panel-default sidebar Begin -->

  <div class="panel-heading center-all">
    <div class="center-all">
      
      <img class="img-responsive center-img" src="customer_images/avatar_loiis.jpg" alt="Peres">
    
      </br>

      <h3 class="panel-title center-all">
      Ảnh đại diện
      </h3>
    </div>

    <div class="panel-body">
      <ul class="nav-pills nav-stacked nav">
        <li class="<?php if(isset($_GET['my_orders'])){echo'active';} ?>">
          <a href="my_account.php?my_orders">
            <i class="fa fa-list"></i> Đơn Hàng
          </a>
        </li>
        <li class="<?php if(isset($_GET['pay_offline'])){echo'active';} ?>">
          <a href="my_account.php?pay_offline">
            <i class="fa fa-bolt"></i> Thanh Toán
          </a>
        </li>
        <li class="<?php if(isset($_GET['edit_account'])){echo'active';} ?>">
          <a href="my_account.php?edit_account">
            <i class="fa fa-pencil"></i> Thay Đổi Thông Tin
          </a>
        </li>
        <li class="<?php if(isset($_GET['change_pass'])){echo'active';} ?>">
          <a href="my_account.php?change_pass">
            <i class="fa fa-user"></i> Thay Đổi Mật Khẩu
          </a>
        </li>
        <li class="<?php if(isset($_GET['delete_account'])){echo'active';} ?>">
          <a href="my_account.php?delete_account">
            <i class="fa fa-trash-o"></i> Xóa Tài Khoản
          </a>
        </li>
        <li>
          <a href="logout.php">
            <i class="fa fa-sign-out"></i> Đăng Xuất
          </a>
        </li>

      </ul>
    </div>
    

  </div>
   
</div> <!-- panel panel-default sidebar Finish -->