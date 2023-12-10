<?php 

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
            Sản phẩm
          </li>
          <li>
            <a href="shop.php?p_cat='<?php echo $product_cat_id; ?>'"> <?php echo $p_cat_title; ?> </a>
          </li>
          <li> <?php echo $pro_title; ?> </li>
        </ul>

      </div> <!-- col-md-12 Finish -->

      <div class="col-md-3"> <!-- col-md-3 Begin -->

        <?php 
          include('views/sidebar.php');
        ?>

      </div> <!-- col-md-3 Finish -->

      <div class="col-md-9"> <!-- col-md-9 Begin -->
        <div id="productMain" class="row"> <!-- row Begin -->
          <div class="col-sm-6"> <!-- col-sm-6 Begin -->
            <div id="mainImage"> <!-- mainImage Begin -->
              <div id="myCarousel" class="carousel slide" data-ride="carousel"> <!-- myCarousel Begin -->

                <ol class="carousel-indicators">
                  <li data-target="myCarousel" data-slide-to="0" class="active" ></li>
                  <li data-target="myCarousel" data-slide-to="1"></li>
                  <li data-target="myCarousel" data-slide-to="2"></li>
                </ol>

                <div class="carousel-inner">
                  <div class="item active">
                    <div class="center-all"><img class="img-responsive" src="admin_area/product_images/<?php echo $pro_img1 ?>" alt="Product-1"></div>
                  </div>
                  <div class="item">
                    <div class="center-all"><img class="img-responsive" src="admin_area/product_images/<?php echo $pro_img2 ?>" alt="Product-2"></div>
                  </div>
                  <div class="item">
                    <div class="center-all"><img class="img-responsive" src="admin_area/product_images/<?php echo $pro_img3 ?>" alt="Product-3"></div>
                  </div>
                </div>

                <a href="#myCarousel" class="left carousel-control" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left">
                    <span class="sr-only">Previous</span>
                  </span>
                </a>

                <a href="#myCarousel" class="right carousel-control" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right ">
                    <span class="sr-only">Next</span>
                  </span>
                </a>

              </div> <!-- myCarousel Finish -->
            </div> <!-- mainImage Finish -->
          </div> <!-- col-sm-6 Finish -->

          <div class="col-sm-6"> <!-- col-sm-6 Begin -->
            <div class="box"> <!-- box Begin -->

              <h1 class="text-center"> <?php echo $pro_title ?> </h1>

              <?php 
              
                addCart();
              
              ?>

              <form name="addToCart" action="details.php?add_cart=<?php echo $pro_id ?>" class="form-horizontal" method="post">
                <div class="form-group"> <!-- form-group Begin -->
                  <label for="" class="col-md-5 control-label">
                    Số lượng
                  </label>

                  <div class="col-md-7"> <!-- col-md-7 Begin -->
                    <select name="product_qty" id="" class="form-control">
                      <option>1 cái</option>
                      <option>2 cái</option>
                      <option>3 cái</option>
                      <option>4 cái</option>
                      <option>5 cái</option>
                    </select>
                  </div> <!-- col-md-7 Finish -->

                </div> <!-- form-group Finish -->

                <div class="form-group"> <!-- form-group Begin -->
                  <label class="col-md-5 control-label">Kích thước</label>

                  <div class="col-md-7"> <!-- col-md-7 Begin -->
                    <select name="product_size" class="form-control" required>

                      <option value='' disabled selected>- Vui lòng chọn -</option>
                      <option>Size S</option>
                      <option>Size M</option>
                      <option>Size L</option>
                      <option>SizeXL</option>
                      <option>Size XXL</option>

                    </select>
                  </div> <!-- col-md-7 Finish -->
                </div> <!-- form-group Finish -->

                <p class="price">Giá: <?php echo $pro_price ?>.000 đ</p>

                <p class="text-center buttons">
                  <button class="btn btn-primary i fa fa-shopping-cart">
                  Thêm vào Giỏ hàng
                  </button>
                </p>

              </form>

            </div> <!-- box Finish -->

            <div class="row" id="thumbs"> <!-- row Begin -->

              <div class="col-xs-4"> <!-- "col-xs-4 Begin -->
                <a data-target="#myCarousel" data-slide-to="0" href="#" class="thumb">
                  <img src="admin_area/product_images/<?php echo $pro_img1 ?>" alt="Product-1" class="img-responsive">
                </a>
              </div> <!-- "col-xs-4 Finish -->

              <div class="col-xs-4"> <!-- "col-xs-4 Begin -->
                <a data-target="#myCarousel" data-slide-to="1" href="#" class="thumb">
                  <img src="admin_area/product_images/<?php echo $pro_img2 ?>" alt="Product-2" class="img-responsive">
                </a>
              </div> <!-- "col-xs-4 Finish -->

              <div class="col-xs-4"> <!-- "col-xs-4 Begin -->
                <a data-target="#myCarousel" data-slide-to="2" href="#" class="thumb">
                  <img src="admin_area/product_images/<?php echo $pro_img3 ?>" alt="Product-3" class="img-responsive">
                </a>
              </div> <!-- "col-xs-4 Finish -->              

            </div> <!-- row Finish -->

          </div> <!-- col-sm-6 Finish -->

        </div> <!-- row Finish -->

        <div class="box" id="details">

          <h4>Chi tiết sản phẩm</h4>
          <p>
            <?php echo $pro_desc ?>
          </p>

          <h4>Size</h4>

          <ul>
            <li>S</li>
            <li>M</li>
            <li>L</li>
            <li>XL</li>
            <li>XXL</li>
          </ul>

        </div>

        <div id="row same-height-row">

          <div class="col-md-3 col-sm-6">
            <div class="box same-height headline">
              <h3 class="text-center">Các sản phẩm khác</h3>
            </div>
          </div>
          
          <?php 
          
            randomProducts(3);
          
          ?>

        </div>

      </div> <!-- col-md-9 Finish -->

    </div> <!--container Finish -->
  </div> <!-- content Finish -->

  <?php 
  
    include('views/footer.php');

  ?>

  <script src="js/jquery-331.min.js"></script>
  <script src="js/bootstrap-337.min.js"></script>
</body>
</html>