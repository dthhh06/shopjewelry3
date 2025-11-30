<?php
require "models/ContactModel.php";

class ContactController {
    private $model;

    function __construct($db) {
        $this->model = new ContactModel($db);
    }

    // danh sách liên hệ
    function index() {
        $contacts = $this->model->getAll();
        $view = "views/contact/list.php";
        include "layouts/main.php";
    }

    // xem chi tiết
    function detail() {
        $id = $_GET["id"] ?? 0;
        $contact = $this->model->getById($id);

        if (!$contact) {
            header("Location: index.php?act=contact");
            exit;
        }

        $view = "views/contact/detail.php";
        include "layouts/main.php";
    }

    // xóa liên hệ
    function delete() {
        $id = $_GET["id"] ?? 0;
        $this->model->delete($id);
        header("Location: index.php?act=contact");
    }
}
