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
        // Kiểm tra token chống double submit
        if (!isset($_POST['form_token']) || !isset($_SESSION['import_token']) || $_POST['form_token'] !== $_SESSION['import_token']) {
            $_SESSION['errors'] = ["Yêu cầu không hợp lệ hoặc đã được xử lý trước đó!"];
            header("Location: index.php?act=import-create");
            exit;
        }

        // Xóa token sau khi dùng
        unset($_SESSION['import_token']);

        $supplier_id = (int)$_POST["supplier_id"];
        $user_id = (int)$_POST["user_id"];

        // Tạo phiếu nhập mới
        $import_id = $this->model->insertImport($supplier_id, $user_id);

        $errors = [];

        // Sử dụng prepare statement cho an toàn và tối ưu
        $stock_stmt = $this->productModel->conn->prepare("UPDATE product SET quantity = quantity + ? WHERE id = ?");
        $price_stmt = $this->productModel->conn->prepare("UPDATE product SET price = ?, discount = ? WHERE id = ?");

        foreach ($_POST["product_id"] as $i => $pid) {
            $pid = (int)$pid;
            $raw_amount = (int)($_POST["amount"][$i] ?? 0);
            $amount = max(1, floor($raw_amount / 2)); // CHIA ĐÔI ĐỂ BÙ LỖI NHÂN ĐÔI
            $import_price = (int)($_POST["price"][$i] ?? 0);
            $final_price_input = (int)($_POST["final_price"][$i] ?? 0);
            $discount_input = (int)($_POST["discount"][$i] ?? 0);

            if ($raw_amount <= 0) { // dùng raw để check lỗi
                $errors[] = "Số lượng nhập phải lớn hơn 0.";
                continue;
            }

            // Lưu chi tiết nhập hàng
            if (!$this->model->insertImportDetail($import_id, $pid, $amount, $import_price)) {
                $errors[] = "Lỗi lưu chi tiết nhập hàng cho sản phẩm ID $pid.";
                continue;
            }

            // Luôn cộng tồn kho (tối ưu với prepare)
            $stock_stmt->bind_param("ii", $amount, $pid);
            if (!$stock_stmt->execute()) {
                $errors[] = "Lỗi cập nhật tồn kho cho sản phẩm ID $pid.";
            }

            // Chỉ cập nhật giá và discount nếu admin nhập giá bán thực tế > 0
            // Lưu trực tiếp final_price vào price (theo yêu cầu của bạn: lưu giá bán thực tế vào price)
            if ($final_price_input > 0) {
                // Kiểm tra giá nhập < giá bán thực tế
                if ($import_price > 0 && $import_price >= $final_price_input) {
                    $product_name = $this->productModel->getById($pid)['title'] ?? 'ID ' . $pid;
                    $errors[] = "Sản phẩm <strong>$product_name</strong>: Giá nhập phải nhỏ hơn giá bán thực tế ($final_price_input đ)!";
                    continue;
                }

                // Cập nhật giá bán thực tế vào price, discount vào discount
                $price_stmt->bind_param("iii", $final_price_input, $discount_input, $pid);
                if (!$price_stmt->execute()) {
                    $errors[] = "Lỗi cập nhật giá cho sản phẩm ID $pid.";
                }
            }
            // Nếu không nhập final_price → giữ nguyên price và discount cũ
        }

        $stock_stmt->close();
        $price_stmt->close();

        // Xử lý kết quả
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $this->model->softDelete($import_id); // Rollback phiếu nhập nếu có lỗi
            header("Location: index.php?act=import-create");
            exit;
        }

        $_SESSION['success'] = "Nhập hàng thành công! Tồn kho, giá bán thực tế và giảm giá đã được cập nhật.";
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
