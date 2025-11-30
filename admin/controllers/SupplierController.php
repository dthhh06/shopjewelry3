<?php
require "models/SupplierModel.php";

class SupplierController {
    private $model;

    function __construct($db) {
        $this->model = new SupplierModel($db);
    }

    function index() {
        $suppliers = $this->model->getAll();
        $view = "views/supplier/list.php";
        include "layouts/main.php";
    }

    function create() {
        $view = "views/supplier/create.php";
        include "layouts/main.php";
    }

    function store() {
        $name = $_POST["name"];
        $address = $_POST["address"];
        $contact = $_POST["contact"];

        $this->model->insert($name, $address, $contact);
        header("Location: index.php?act=supplier");
    }

    function edit() {
        $id = $_GET["id"];
        $supplier = $this->model->getById($id);
        $view = "views/supplier/edit.php";
        include "layouts/main.php";
    }

    function update() {
        $id = $_POST["id"];
        $name = $_POST["name"];
        $address = $_POST["address"];
        $contact = $_POST["contact"];

        $this->model->update($id, $name, $address, $contact);
        header("Location: index.php?act=supplier");
    }

    function delete() {
        $id = $_GET["id"];
        $this->model->delete($id);
        header("Location: index.php?act=supplier");
    }
}
