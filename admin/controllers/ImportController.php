<?php
require "models/ImportModel.php";
require "models/ProductModel.php";
require "models/SupplierModel.php";
require "models/UserModel.php";

class ImportController {
    private $model;
    private $productModel;
    private $supplierModel;
    private $userModel;

    function __construct($db) {
        $this->model = new ImportModel($db);
        $this->productModel = new ProductModel($db);
        $this->supplierModel = new SupplierModel($db);
        $this->userModel = new UserModel($db);
    }

    function index() {
        $imports = $this->model->getAll();
        $view = "views/import/list.php";
        include "layouts/main.php";
    }

    function create() {
        $products = $this->productModel->getAll();
        $suppliers = $this->supplierModel->getAll();
        $users = $this->userModel->getStaffs();


        $view = "views/import/create.php";
        include "layouts/main.php";
    }

    function store() {
        $supplier_id = $_POST["supplier_id"];
        $user_id = $_POST["user_id"];

        // Tạo import mới
        $import_id = $this->model->insertImport($supplier_id, $user_id);

        // Lưu danh sách sản phẩm
        foreach ($_POST["product_id"] as $i => $pid) {
            $amount = $_POST["amount"][$i];
            $price = $_POST["price"][$i];

            if ($amount > 0) {
                $this->model->insertImportDetail($import_id, $pid, $amount, $price);
            }
        }

        header("Location: index.php?act=import");
    }

    function show() {
        $id = $_GET["id"];
        $import = $this->model->getById($id);
        $details = $this->model->getDetails($id);
        $view = "views/import/show.php";
        include "layouts/main.php";
    }

    function delete() {
        $id = $_GET["id"];
        $this->model->softDelete($id);
        header("Location: index.php?act=import");
    }
    function detail() {
    $id = $_GET["id"]; // import_id
    
    $import = $this->model->getById($id);
    $details = $this->model->getDetails($id);

    $view = "views/import/detail.php";
    include "layouts/main.php";
}

}
