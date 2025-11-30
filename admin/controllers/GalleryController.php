<?php
require "models/GalleryModel.php";

class GalleryController {
    private $model;

    function __construct($db) {
        $this->model = new GalleryModel($db);
    }

    // Danh sách
    function index() {
        $galleries = $this->model->getAll();
        $view = "views/gallery/list.php";
        include "layouts/main.php";
    }

    // Form tạo
    function create() {
        $view = "views/gallery/create.php";
        include "layouts/main.php";
    }

    // Lưu khi thêm
    function store() {
        $title = $_POST['title'];

        // Upload file
        $filename = "";
        if ($_FILES['thumbnail']['name']) {
            $path = "shopjewelry3/public/assets/imgs";
            $filename = $path . time() . "_" . basename($_FILES['thumbnail']['name']);
            move_uploaded_file($_FILES['thumbnail']['tmp_name'], $filename);
        }

        $this->model->insert($title, $filename);
        header("Location: index.php?act=galleries");
    }

    // Form sửa
    function edit() {
        $id = $_GET['id'];
        $gallery = $this->model->getById($id);
        $view = "views/gallery/edit.php";
        include "layouts/main.php";
    }

    // Lưu khi sửa
    function update() {
        $id = $_POST['id'];
        $title = $_POST['title'];

        $thumbnail = null;

        if ($_FILES['thumbnail']['name']) {
            $path = "shopjewelry3/public/assets/imgs";
            $thumbnail = $path . time() . "_" . basename($_FILES['thumbnail']['name']);
            move_uploaded_file($_FILES['thumbnail']['tmp_name'], $thumbnail);
        }

        $this->model->update($id, $title, $thumbnail);
        header("Location: index.php?act=galleries");
    }

    // Xóa
    function delete() {
        $id = $_GET['id'];
        $this->model->delete($id);
        header("Location: index.php?act=galleries");
    }
}
