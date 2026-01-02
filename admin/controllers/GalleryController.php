<?php
require_once "models/ProductModel.php";

class GalleryController
{
    private $productModel;

    function __construct($db)
    {
        $this->productModel = new ProductModel($db);
    }

    function index()
    {
        $products = $this->productModel->getAll();
        $view = "views/gallery/list.php"; // File view mình sẽ gửi dưới
        include "layouts/main.php";
    }
}