<?php
require_once "models/ProductModel.php";

class ProductController {

    private $model;

    function __construct($db) {
        $this->model = new ProductModel($db);
    }

    function index() {
        $products = $this->model->getAll();
        $view = "views/products/list.php";
        include "layouts/main.php";
    }

    function create() {
        // Lấy category để load lên select
        $cats = $this->model->conn->query("SELECT * FROM category WHERE isDeleted = 0");
        $view = "views/products/create.php";
        include "layouts/main.php";
    }

    function store() {

        // ========== XỬ LÝ UPLOAD ẢNH ========== //
        $thumbnail = "";

        if (!empty($_FILES["thumbnail"]["name"])) {

            $folder = "shopjewelry3/public/assets/imgs";
            if (!is_dir($folder)) mkdir($folder, 0777, true);

            $fileName = time() . "_" . basename($_FILES["thumbnail"]["name"]);
            $target = $folder . $fileName;

            move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $target);

            $thumbnail = $target;
        }

        // ========== LƯU DỮ LIỆU ========== //
        $data = [
            "title"         => $_POST["title"],
            "price"         => $_POST["price"],
            "category_id"   => $_POST["category_id"],
            "discount"      => $_POST["discount"],
            "thumbnail"     => $thumbnail,
            "description"   => $_POST["description"],
            "quantity"      => $_POST["quantity"]
        ];

        $this->model->insert($data);

        header("Location: index.php?act=products");
    }

    function edit() {
        $id = $_GET["id"];
        $product = $this->model->getById($id);
        $cats = $this->model->conn->query("SELECT * FROM category WHERE isDeleted = 0");

        $view = "views/products/edit.php";
        include "layouts/main.php";
    }

    function update() {
        $id = $_POST["id"];

        $thumbnail = $_POST["old_thumbnail"];

        // Nếu đổi ảnh
        if (!empty($_FILES["thumbnail"]["name"])) {

            $folder = "shopjewelry3/public/assets/imgs";
            if (!is_dir($folder)) mkdir($folder, 0777, true);

            $fileName = time() . "_" . basename($_FILES["thumbnail"]["name"]);
            $target = $folder . $fileName;

            move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $target);

            $thumbnail = $target;
        }

        $data = [
            "title"         => $_POST["title"],
            "price"         => $_POST["price"],
            "category_id"   => $_POST["category_id"],
            "discount"      => $_POST["discount"],
            "thumbnail"     => $thumbnail,
            "description"   => $_POST["description"],
            "quantity"      => $_POST["quantity"]
        ];

        $this->model->update($id, $data);

        header("Location: index.php?act=products");
    }

    function delete() {
        $id = $_GET["id"];
        $this->model->softDelete($id);

        header("Location: index.php?act=products");
    }
}
