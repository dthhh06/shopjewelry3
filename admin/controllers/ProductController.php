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
        // Lấy category để load lên select
        $cats = $this->model->conn->query("SELECT * FROM category WHERE isDeleted = 0");
        $view = "views/products/create.php";
        include "layouts/main.php";
    }
    function store()
    {

        // ========== XỬ LÝ UPLOAD ẢNH ========== //
        $folder = "../assets/imgs/";
        if (!is_dir($folder)) mkdir($folder, 0777, true);

        // Thumbnail
        $thumbnail = "";
        if (!empty($_FILES["thumbnail"]["name"])) {
            $fileName = time() . "_" . $_FILES["thumbnail"]["name"];
            move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $folder . $fileName);
            $thumbnail = $folder . $fileName;
        }

        // Image 1
        $image1 = "";
        if (!empty($_FILES["image1"]["name"])) {
            $fileName = time() . "_1_" . $_FILES["image1"]["name"];
            move_uploaded_file($_FILES["image1"]["tmp_name"], $folder . $fileName);
            $image1 = $folder . $fileName;
        }

        // Image 2
        $image2 = "";
        if (!empty($_FILES["image2"]["name"])) {
            $fileName = time() . "_2_" . $_FILES["image2"]["name"];
            move_uploaded_file($_FILES["image2"]["tmp_name"], $folder . $fileName);
            $image2 = $folder . $fileName;
        }

        // ========== LƯU DỮ LIỆU ========== //
        $data = [
            "title"         => $_POST["title"],
            "price"         => $_POST["price"],
            "category_id"   => $_POST["category_id"],
            "discount"      => $_POST["discount"],
            "thumbnail"     => $thumbnail,
            "image1"        => $image1,
            "image2"        => $image2,
            "description"   => $_POST["description"],
            "quantity"      => $_POST["quantity"]
        ];

        $this->model->insert($data);

        header("Location: index.php?act=products");
    }


    function edit()
    {
        $id = $_GET["id"];
        $product = $this->model->getById($id);
        $cats = $this->model->conn->query("SELECT * FROM category WHERE isDeleted = 0");

        $view = "views/products/edit.php";
        include "layouts/main.php";
    }

    function update()
    {
        $id = $_POST["id"];

        $folder = "../assets/imgs/";
        if (!is_dir($folder)) mkdir($folder, 0777, true);

        $thumbnail = $_POST["old_thumbnail"];
        $image1 = $_POST["old_image1"];
        $image2 = $_POST["old_image2"];

        // Thumbnail
        if (!empty($_FILES["thumbnail"]["name"])) {
            $fileName = time() . "_" . $_FILES["thumbnail"]["name"];
            move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $folder . $fileName);
            $thumbnail = $folder . $fileName;
        }

        // Image 1
        if (!empty($_FILES["image1"]["name"])) {
            $fileName = time() . "_1_" . $_FILES["image1"]["name"];
            move_uploaded_file($_FILES["image1"]["tmp_name"], $folder . $fileName);
            $image1 = $folder . $fileName;
        }

        // Image 2
        if (!empty($_FILES["image2"]["name"])) {
            $fileName = time() . "_2_" . $_FILES["image2"]["name"];
            move_uploaded_file($_FILES["image2"]["tmp_name"], $folder . $fileName);
            $image2 = $folder . $fileName;
        }

        $data = [
            "title"         => $_POST["title"],
            "price"         => $_POST["price"],
            "category_id"   => $_POST["category_id"],
            "discount"      => $_POST["discount"],
            "thumbnail"     => $thumbnail,
            "image1"        => $image1,
            "image2"        => $image2,
            "description"   => $_POST["description"],
            "quantity"      => $_POST["quantity"]
        ];

        $this->model->update($id, $data);

        header("Location: index.php?act=products");
    }

    function delete()
    {
        $id = $_GET["id"];
        $this->model->delete($id);

        header("Location: index.php?act=products");
    }
}
