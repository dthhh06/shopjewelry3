<?php
require_once "models/ProductModel.php";

class ProductController
{
    private $model;

    function __construct($db)
    {
        $this->model = new ProductModel($db);
    }

    function index()
    {
        $products = $this->model->getAll();
        $view = "views/products/list.php";
        include "layouts/main.php";
    }

    function create()
    {
        // Lấy danh mục để hiển thị trong select
        $cats = $this->model->conn->query("SELECT * FROM category WHERE isDeleted = 0");
        $view = "views/products/create.php";
        include "layouts/main.php";
    }

    function store()
    {
        // ========== XỬ LÝ UPLOAD ẢNH ========== //
        $folder = "../assets/imgs/";
        if (!is_dir($folder)) mkdir($folder, 0777, true);

        // Thumbnail - BẮT BUỘC khi thêm mới
        $thumbnail = "";
        if (!empty($_FILES["thumbnail"]["name"])) {
            $fileName = time() . "_thumb_" . $_FILES["thumbnail"]["name"];
            move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $folder . $fileName);
            $thumbnail = $folder . $fileName;
        } else {
            // Nếu không upload thumbnail → báo lỗi (tùy chọn)
            $_SESSION['error'] = "Vui lòng upload ảnh chính (thumbnail)!";
            header("Location: index.php?act=product-create");
            exit;
        }

        // Image 1 - Tùy chọn
        $image1 = "";
        if (!empty($_FILES["image1"]["name"])) {
            $fileName = time() . "_1_" . $_FILES["image1"]["name"];
            move_uploaded_file($_FILES["image1"]["tmp_name"], $folder . $fileName);
            $image1 = $folder . $fileName;
        }

        // Image 2 - Tùy chọn
        $image2 = "";
        if (!empty($_FILES["image2"]["name"])) {
            $fileName = time() . "_2_" . $_FILES["image2"]["name"];
            move_uploaded_file($_FILES["image2"]["tmp_name"], $folder . $fileName);
            $image2 = $folder . $fileName;
        }

        // ========== LƯU DỮ LIỆU ========== //
        // Không còn price, discount, quantity ở đây nữa
        // Chúng sẽ được cập nhật khi nhập hàng (Import)
        $data = [
            "title"         => $_POST["title"],
            "category_id"   => $_POST["category_id"],
            "thumbnail"     => $thumbnail,
            "image1"        => $image1,
            "image2"        => $image2,
            "description"   => $_POST["description"] ?? ''
        ];

        $this->model->insert($data);

        $_SESSION['success'] = "Thêm sản phẩm thành công! Hãy nhập hàng để cập nhật giá và số lượng.";
        header("Location: index.php?act=products");
        exit;
    }

    function edit()
    {
        $id = (int)$_GET["id"];
        $product = $this->model->getById($id);

        if (!$product) {
            $_SESSION['error'] = "Không tìm thấy sản phẩm!";
            header("Location: index.php?act=products");
            exit;
        }

        $cats = $this->model->conn->query("SELECT * FROM category WHERE isDeleted = 0");

        $view = "views/products/edit.php";
        include "layouts/main.php";
    }

    function update()
    {
        $id = (int)$_POST["id"];

        $folder = "../assets/imgs/";
        if (!is_dir($folder)) mkdir($folder, 0777, true);

        // Lấy ảnh cũ từ hidden fields
        $thumbnail = $_POST["old_thumbnail"] ?? '';
        $image1 = $_POST["old_image1"] ?? '';
        $image2 = $_POST["old_image2"] ?? '';

        // Thumbnail mới (nếu có)
        if (!empty($_FILES["thumbnail"]["name"])) {
            $fileName = time() . "_thumb_" . $_FILES["thumbnail"]["name"];
            move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $folder . $fileName);
            $thumbnail = $folder . $fileName;
        }

        // Image 1 mới
        if (!empty($_FILES["image1"]["name"])) {
            $fileName = time() . "_1_" . $_FILES["image1"]["name"];
            move_uploaded_file($_FILES["image1"]["tmp_name"], $folder . $fileName);
            $image1 = $folder . $fileName;
        }

        // Image 2 mới
        if (!empty($_FILES["image2"]["name"])) {
            $fileName = time() . "_2_" . $_FILES["image2"]["name"];
            move_uploaded_file($_FILES["image2"]["tmp_name"], $folder . $fileName);
            $image2 = $folder . $fileName;
        }

        // ========== CẬP NHẬT DỮ LIỆU ========== //
        $data = [
            "title"         => $_POST["title"],
            "category_id"   => $_POST["category_id"],
            "thumbnail"     => $thumbnail,
            "image1"        => $image1,
            "image2"        => $image2,
            "description"   => $_POST["description"] ?? ''
        ];

        $this->model->update($id, $data);

        $_SESSION['success'] = "Cập nhật sản phẩm thành công!";
        header("Location: index.php?act=products");
        exit;
    }

    function delete()
    {
        $id = (int)$_GET["id"];
        $this->model->delete($id);

        $_SESSION['success'] = "Xóa sản phẩm thành công!";
        header("Location: index.php?act=products");
        exit;
    }
}