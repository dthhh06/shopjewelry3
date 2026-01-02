<?php
require_once "models/ProductModel.php";

class StockController
{
    private $model;

    function __construct($db)
    {
        $this->model = new ProductModel($db);
    }

    function index()
    {
        $products = $this->model->getAll()->fetch_all(MYSQLI_ASSOC); // Lấy hết dưới dạng mảng
        $view = "views/stock/list.php";
        include "layouts/main.php";
    }
}