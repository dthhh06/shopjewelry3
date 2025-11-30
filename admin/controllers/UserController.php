<?php
require_once "models/UserModel.php";

class UserController {

    private $model;

    function __construct($db) {
        $this->model = new UserModel($db);
    }

    function index() {
        $users = $this->model->getAll();
        $view = "views/users/list.php";
        include "layouts/main.php";
    }

    function create() {
        // Lấy danh sách role
        $roles = $this->model->conn->query("SELECT * FROM role");
        $view = "views/users/create.php";
        include "layouts/main.php";
    }

    function store() {

        // Validate password trống
        if (empty($_POST['password'])) {
            die("Password không được để trống!");
        }

        $data = [
            "fullname"      => $_POST["fullname"],
            "email"         => $_POST["email"],
            "phone_number"  => $_POST["phone_number"],
            "password"      => $_POST["password"],
            "role_id"       => $_POST["role_id"]
        ];

        $this->model->insert($data);

        header("Location: index.php?act=users");
    }

    function edit() {
        $id = $_GET["id"];
        $user = $this->model->getById($id);
        $roles = $this->model->conn->query("SELECT * FROM role");

        $view = "views/users/edit.php";
        include "layouts/main.php";
    }

    function update() {
        $id = $_POST["id"];

        $data = [
            "fullname"      => $_POST["fullname"],
            "email"         => $_POST["email"],
            "phone_number"  => $_POST["phone_number"],
            "password"      => $_POST["password"], // optional
            "role_id"       => $_POST["role_id"]
        ];

        $this->model->update($id, $data);

        header("Location: index.php?act=users");
    }

    function delete() {
        $id = $_GET["id"];
        $this->model->softDelete($id);
        header("Location: index.php?act=users");
    }
}
