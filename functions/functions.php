<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $db = "ecom_store";
    try {
        $conn = new PDO("mysql:host=$host;dbname=$db", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
    
    // Function from tutorial
    function getRealIPUser () {

        switch(true){
            case(!empty($_SERVER['HTTP_X_REAL_IP'])) : return $_SERVER['HTTP_X_REAL_IP']; 
            case(!empty($_SERVER['HTTP_CLIENT_IP'])) : return $_SERVER['HTTP_CLIENT_IP']; 
            case(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) : return $_SERVER['HTTP_X_FORWARDED_FOR']; 

            default : return $_SERVER['REMOTE_ADDR']; 
        }

    }

    // Function from PHP Documentation
    function real_ip() {
        $ip = $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches)) {
            foreach ($matches[0] AS $xip) {
                if (!preg_match('#^(10|172\.16|192\.168)\.#', $xip)) {
                    $ip = $xip;
                    break;
                }
            }
        } elseif (isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_CF_CONNECTING_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CF_CONNECTING_IP'])) {
            $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
        } elseif (isset($_SERVER['HTTP_X_REAL_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_X_REAL_IP'])) {
            $ip = $_SERVER['HTTP_X_REAL_IP'];
        }
        return $ip;
    }

    function addCart() {

        global $conn;

        if(isset($_GET['add_cart'])){

            $ip_add = real_ip();
            $p_id = $_GET['add_cart'];
            $product_qty = $_POST['product_qty'];
            $product_size = $_POST['product_size'];
            $check_product = "select count(*) from cart where ip_add = '$ip_add' AND p_id = '$p_id'";
            $run_check = $conn->query($check_product);

            if($row_check=$run_check->fetchColumn()) {

                echo "<script> alert('This product has been added to the cart already.'); </script>";
                echo "<script> window.open('details.php?pro_id='$p_id','self'); </script>";

            } else {

                $insert_to_cart = "insert into cart (p_id, ip_add, qty, size) values (?,?,?,?)";
                $conn->prepare($insert_to_cart)->execute([$p_id, $ip_add , $product_qty, $product_size]);

                echo "<script>window.open('details.php?pro_id=$p_id','_self')</script>";

            }

        }

    }

    function getPro(){

        global $conn;

        $get_products = "select * from product order by 1 desc limit 0,8";

        $run_products = $conn->query($get_products);

        while($row_products=$run_products->fetch()) {
            
            $pro_id = $row_products['product_id'];
            $pro_title = $row_products['product_title'];
            $pro_price = $row_products['product_price'];
            $pro_img1 = $row_products['product_img1'];

            echo "
            
                <div class='col-md-4 col-sm-6 single'>
                    <div class='product'>
                        <a href='details.php?pro_id=$pro_id'>
                            <img class='img-responsive' src='admin_area/product_images/$pro_img1'>
                        </a>

                        <div class='text'>
                            <h3>
                                <a href='details.php?pro_id=$pro_id'>
                                
                                    $pro_title
                                
                                </a>
                            
                            </h3>

                            <p class='price'>
                            
                                 $pro_price đ
                            
                            </p>

                            <p class='button'>
                                <a class='btn btn-default' href='details.php?pro_id=$pro_id'>
                                    Chi tiết
                                </a>
                                <a class='btn btn-primary' href='details.php?pro_id=$pro_id'>
                                    <i class='fa fa-shopping-cart'></i> Thêm vào Giỏ hàng
                                </a>
                            </p>
                        
                        </div>
                    </div>
                </div>
            ";

        }

    }

    function getPCategories(){

        global $conn;

        $get_p_categories = "select * from product_categories";
        $run_p_categories = $conn->query($get_p_categories);

        while($row_p_categories = $run_p_categories->fetch()) {

            $p_cat_id = $row_p_categories['p_cat_id'];
            $p_cat_title = $row_p_categories['p_cat_title'];

            echo "
            
                <li>
                    <a href='shop.php?p_cat=$p_cat_id'> $p_cat_title </a>
                </li>
            
            ";

        }

    }

    function getCategories() {

        global $conn;

        $get_categories = "select * from categories;";
        $run_categories = $conn->query($get_categories);

        while($row_categories=$run_categories->fetch()) {

            $cat_id = $row_categories['cat_id'];
            $cat_title = $row_categories['cat_title'];

            echo "
            
                <li>
                
                    <a href='shop.php?cat=$cat_id'> $cat_title</a>
                
                </li>
            
            ";

        }

    }

    function displayCategories() {

        global $conn;

        if(isset($_GET['p_cat'])) {

            $p_cat_id = $_GET['p_cat'];

            $get_p_cat = "select * from product_categories where p_cat_id = '$p_cat_id'";
            $run_p_cat = $conn->query($get_p_cat);
            $row_p_cat = $run_p_cat->fetch();
            $p_cat_title = $row_p_cat['p_cat_title'];
            $p_cat_top = $row_p_cat['p_cat_top'];

            $query_count_products = "select count(*) from product where p_cat_id = '$p_cat_id'";
            $run_products = $conn->query($query_count_products);
            $get_count_products = $run_products->fetchColumn();

            if($get_count_products == 0) {

                echo "
                
                    <div class='box'>
                        No Product found in this product category.
                    </div>
                
                ";

            } else {
                echo "
                
                    <div class='box'>
                        <h1> $p_cat_title </h1>
                        <p> $p_cat_top </p>
                    </div>
                
                ";
            }

            $get_products = "select * from product where p_cat_id = '$p_cat_id'";
            $run_products = $conn->query($get_products);

            while($row_products=$run_products->fetch()){

                $pro_id = $row_products['product_id'];
                $pro_title = $row_products['product_title'];
                $pro_price = $row_products['product_price'];
                $pro_img1 = $row_products['product_img1'];

                echo "
            
                    <div class='col-md-4 col-sm-6 center-responsive'>
                        <div class='product'>
                            <a href='details.php?pro_id=$pro_id'>
                                <img class='img-responsive' src='admin_area/product_images/$pro_img1'>
                            </a>

                            <div class='text'>
                                <h3>
                                    <a href='details.php?pro_id=$pro_id'>
                                    
                                        $pro_title
                                    
                                    </a>
                                
                                </h3>

                                <p class='price'>
                                
                                    CA$ $pro_price
                                
                                </p>

                                <p class='button'>
                                    <a class='btn btn-default' href='details.php?pro_id=$pro_id'>
                                        Chi tiết
                                    </a>
                                    <a class='btn btn-primary' href='details.php?pro_id=$pro_id'>
                                        <i class='fa fa-shopping-cart'></i> Thêm vào Giỏ hàng
                                    </a>
                                </p>
                            
                            </div>
                        </div>
                    </div>
                ";

            }
        }
    }

    function getCategorieProducts(){

        global $conn;

        if(isset($_GET['cat'])) {

            $cat_id = $_GET['cat'];
            $get_cat = "select * from categories where cat_id = '$cat_id'";
            $run_cat = $conn->query($get_cat);
            $row_cat = $run_cat->fetch();

            $cat_title = $row_cat['cat_title'];
            $cat_desc = $row_cat['cat_desc'];

            $count_products = "select count(*) from product where cat_id = '$cat_id'";
            $run_count_products = $conn->query($count_products);
            $products_quantity = $run_count_products->fetchColumn();

            if($products_quantity == 0) {
                
                echo "

                    <div class='box'>
                        <h1>Không tìm thấy sản phẩm nào trong danh mục này</h1>
                    </div>
                
                ";

            } else {
                echo "

                    <div class='box'>
                        <h1> $cat_title </h1>
                        <p> $cat_desc </p>
                    </div>
                
                ";
            }

            $get_products = "select * from product where cat_id = '$cat_id' LIMIT 0,6";
            $run_get_products = $conn->query($get_products);
            

            while($row_products=$run_get_products->fetch()){

                $pro_id = $row_products['product_id'];
                $pro_title = $row_products['product_title'];
                $pro_price = $row_products['product_price'];
                $pro_desc = $row_products['product_desc'];
                $pro_img1 = $row_products['product_img1'];

                echo "
                  
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
                              Chi tiết
                            </a>
                            <a class='btn btn-primary' href='details.php?pro_id=$pro_id'>
                              <i class='fa fa-shopping-cart'></i> Thêm vào Giỏ hàng
                            </a>
                          </p>
                        </div>
                      </div>
                    </div>

                  ";

            }

        }
        
    }

    function itemsInCart() {

        global $conn;

        $ip_add = real_ip();
        $get_items = "select count(*) from cart where ip_add = '$ip_add'";
        $run_items = $conn->query($get_items);
        $count_items = $run_items->fetchColumn();

        echo $count_items;

    }

    function cartTotal() {

        global $conn;

        $ip_add = real_ip();
        $total_sum = 0;
        $select_cart = "select * from cart where ip_add = '$ip_add'";
        $run_items = $conn->query($select_cart);

        while($count_items = $run_items->fetch()) {
            
            $pro_id = $count_items['p_id'];
            $pro_qty = $count_items['qty'];
            $get_price = "select * from product where product_id = '$pro_id'";
            $run_price = $conn->query($get_price);

            while($row_price=$run_price->fetch()) {

                $subtotal = $row_price['product_price'] * $pro_qty;
                $total_sum += $subtotal;
            }

        }

        if($total_sum == ''){
            echo "0 đ";
        } else {
            echo  $total_sum." đ";
        }

    }

    function removeFromCart() {

        global $conn;

        if(isset($_POST['update'])) {

            foreach($_POST['remove'] as $remove_id){

                $delete_product = "delete from cart where p_id='$remove_id'";
                $run_delete = $conn->query($delete_product);
                
                if($run_delete) {
                    echo "<script>window.open('cart.php', '_self')</script>";
                }

            }

        }

    }

    function randomProducts($quantity) {

    global $conn;

    $get_products = "select * from product order by rand() LIMIT 0,$quantity";
        $run_get_products = $conn->query($get_products);

        while($row_get_products=$run_get_products->fetch()) {

            $pro_id = $row_get_products['product_id'];
            $pro_title = $row_get_products['product_title'];
            $pro_price = $row_get_products['product_price'];
            $pro_img1 = $row_get_products['product_img1'];

            echo "
                
            <div class='col-md-3 col-sm-6 center-responsive .flex-container'>
                <div class='product same-height'>
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
                </div>
                </div>
            </div>

            ";

        }

    }

    //Chức năng sendmessage feedback
    function sendMessage() {

    if(isset($_POST['submit'])) {

        $sender_name = $_POST['name'];
        $sender_email = $_POST['email'];
        $sender_subject = $_POST['subject'];
        $sender_message = $_POST['message'];
        $email_receiver = 'tranloikontum@gmail.com';

        //Phần heaeder email code
        $headers = "From: tranloikontum@gmail.com";
        $headers .= "Reply-To: tranloikontum@gmail.com";
        //========

        //mail($email_receiver, $sender_name, $sender_subject, $sender_message, $sender_email, $headers);

        // Tự động trả lời
        $email = $_POST['email'];
        $messagefirt = 'Cảm ơn';
        $messagetwo = 'đã ghé thăm shop.';
        $from = 'tranloikontum@gmail.com';

        // Phần auto header email code
        $auto_reply_headers = "From: tranloikontum@gmail.com\r\n";
        $auto_reply_headers .= "Reply-To: tranloikontum@gmail.com\r\n";
        //======

        //mail($email, $subject, $msg, $from, $auto_reply_headers);

        echo "<h2> Gửi thành công! </h2>". 
        "<h2>".$messagefirt. " ". $sender_name. " ".$messagetwo."</h2>".
       "<h4>Chúng tôi sẽ phản hồi trong thời gian sớm nhất.</h4>";
        
          
        }

    }

    /**
     * Check $_FILES[][name]
     *
     * @param (string) $filename, $tmp, $path - Uploaded file name.
     * @author FDiegoPeres
     */
    function validate_img_security ($filename, $tmp, $path) {

        try{

            $uploads_dir = pathinfo($path.$filename);
        
            if(!((bool) ((preg_match("`^[-0-9A-Z_\.]+$`i", $filename)) ? true : false))){
                throw new RuntimeException('The image title cannot contain special characters.');

            } else if((bool) ((mb_strlen($filename,"UTF-8") > 225) ? true : false)) {
                throw new RuntimeException('Please, remain your image title less than 255 characters.');

            } else if(!($uploads_dir['extension'] != 'jpg' || $uploads_dir['extension'] != 'jpeg' || $uploads_dir['extension'] != 'png')) {
                throw new RuntimeException('Sorry, only PNG or JPG images are allowed.');

            } else if($uploads_dir['size'] > 4000000) {
                throw new RuntimeException('Sorry, size max is 4MB.');
            }

            // Destructuring the data into variables 
            [ 'basename' => $basename, 'dirname' => $dirname ] = $uploads_dir;

            move_uploaded_file($tmp, $dirname."/".$basename);

        } catch (RuntimeException $e) {

            echo $e->getMessage();
        
        }

    }


?>

