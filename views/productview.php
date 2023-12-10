<?php
class ProductView {
    public function displayProducts($products) {
        while ($row_products = $products->fetch()) {
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
                                $pro_price.000đ
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

    public function displayProductCategories($p_categories) {
        while ($row_p_categories = $p_categories->fetch()) {
            $p_cat_id = $row_p_categories['p_cat_id'];
            $p_cat_title = $row_p_categories['p_cat_title'];

            echo "
                <li>
                    <a href='shop.php?p_cat=$p_cat_id'>$p_cat_title</a>
                </li>
            ";
        }
    }
}
?>