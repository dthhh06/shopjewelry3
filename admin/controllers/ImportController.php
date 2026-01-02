<?php
require "models/ImportModel.php";
require "models/ProductModel.php";
require "models/SupplierModel.php";
require "models/UserModel.php";

class ImportController
{
    private $model;
    private $productModel;
    private $supplierModel;
    private $userModel;

    function __construct($db)
    {
        $this->model = new ImportModel($db);
        $this->productModel = new ProductModel($db);
        $this->supplierModel = new SupplierModel($db);
        $this->userModel = new UserModel($db);
    }

    function index()
    {
        $imports = $this->model->getAll();
        $view = "views/import/list.php";
        include "layouts/main.php";
    }

    function create()
    {
        $products = $this->productModel->getAll();
        $suppliers = $this->supplierModel->getAll();
        $users = $this->userModel->getStaffs();


        $view = "views/import/create.php";
        include "layouts/main.php";
    }

    function store()
    {
        $supplier_id = $_POST["supplier_id"];
        $user_id = $_POST["user_id"];

        $import_id = $this->model->insertImport($supplier_id, $user_id);

        $errors = [];

        foreach ($_POST["product_id"] as $i => $pid) {
            $pid = (int)$pid;
            $amount = (int)($_POST["amount"][$i] ?? 0);
            $import_price = (int)($_POST["price"][$i] ?? 0);           // Giá nhập
            $sale_price = (int)($_POST["sale_price"][$i] ?? 0);       // Giá bán ra
            $discount = (int)($_POST["discount"][$i] ?? 0);

            if ($amount <= 0) {
                $errors[] = "Số lượng phải lớn hơn 0.";
                continue;
            }

            if ($import_price < 0 || $sale_price <= 0) {
                $errors[] = "Giá nhập và giá bán phải là số dương.";
                continue;
            }

            if ($discount < 0 || $discount > 99) {
                $errors[] = "Giảm giá phải từ 0 đến 99%.";
                continue;
            }

            $final_price = $sale_price * (100 - $discount) / 100;

            if ($import_price >= $final_price) {
                $product_name = $this->productModel->getById($pid)['title'] ?? 'ID ' . $pid;
                $errors[] = "Sản phẩm <strong>$product_name</strong>: Giá nhập ($import_price đ) phải nhỏ hơn giá bán sau giảm ($final_price đ)!";
                continue;
            }

            // Lưu chi tiết nhập
            $this->model->insertImportDetail($import_id, $pid, $amount, $import_price);

            // Cập nhật giá bán, giảm giá, tồn kho cho sản phẩm
            $updated = $this->productModel->updatePriceAndStock($pid, $sale_price, $discount, $amount, $import_price);

            if (!$updated) {
                $errors[] = "Lỗi cập nhật sản phẩm ID $pid.";
            }
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $this->model->softDelete($import_id); // Xóa phiếu nếu có lỗi
            header("Location: index.php?act=import-create");
            exit;
        }

        $_SESSION['success'] = "Nhập hàng thành công! Giá bán và tồn kho đã được cập nhật.";
        header("Location: index.php?act=import");
        exit;
    }

    function show()
    {
        $id = $_GET["id"];
        $import = $this->model->getById($id);
        $details = $this->model->getDetails($id);
        $view = "views/import/show.php";
        include "layouts/main.php";
    }

    function delete()
    {
        $id = $_GET["id"];
        $this->model->softDelete($id);
        header("Location: index.php?act=import");
    }
    function detail()
    {
        if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
            header("Location: index.php?act=import");
            exit;
        }

        $id = (int)$_GET["id"];

        $import = $this->model->getById($id);
        if (!$import) {
            header("Location: index.php?act=import");
            exit;
        }

        $details = $this->model->getDetails($id);

        $view = "views/import/detail_content.php";
        include "layouts/main.php";
    }
}
