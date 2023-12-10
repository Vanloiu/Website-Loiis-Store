<?php
class ProductController {
    private $model;
    private $view;

    public function __construct($model, $view) {
        $this->model = $model;
        $this->view = $view;
    }

    public function getProducts() {
        $products = $this->model->getProducts();
        $this->view->displayProducts($products);
    }

    public function getProductCategories() {
        $p_categories = $this->model->getProductCategories();
        $this->view->displayProductCategories($p_categories);
    }
}
?>