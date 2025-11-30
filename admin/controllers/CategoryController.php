<?php
require "models/CategoryModel.php";

class CategoryController {
    private $model;

    function __construct($db) {
        $this->model = new CategoryModel($db);
    }

    function index() {
        $categories = $this->model->getAll();
        $view = "views/category/list.php";
        include "layouts/main.php";
    }

    function create() {
        $view = "views/category/create.php";
        include "layouts/main.php";
    }

    function store() {
        $name = $_POST["name"];
        $this->model->insert($name);
        header("Location: index.php?act=category");
    }

    function edit() {
        $id = $_GET["id"];
        $category = $this->model->getById($id);
        $view = "views/category/edit.php";
        include "layouts/main.php";
    }

    function update() {
        $id = $_POST["id"];
        $name = $_POST["name"];
        $this->model->update($id, $name);
        header("Location: index.php?act=category");
    }

    function delete() {
        $id = $_GET["id"];
        $this->model->delete($id);
        header("Location: index.php?act=category");
    }
}
