<?php
class ProductModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getProducts() {
        $get_products = "SELECT * FROM product ORDER BY product_id DESC LIMIT 0,8";
        $run_products = $this->conn->query($get_products);
        return $run_products;
    }

    public function getProductCategories() {
        $get_p_categories = "SELECT * FROM product_categories";
        $run_p_categories = $this->conn->query($get_p_categories);
        return $run_p_categories;
    }
}
?>