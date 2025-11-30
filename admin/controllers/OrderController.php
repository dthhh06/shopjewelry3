<?php
require "models/OrderModel.php";

class OrderController {
    private $model;

    function __construct($db) {
        $this->model = new OrderModel($db);
    }

    // danh sách
    function index() {
        $orders = $this->model->getAll();
        $view = "views/order/list.php";
        include "layouts/main.php";
    }

    // xem chi tiết
    function detail() {
        $id = $_GET['id'] ?? 0;
        $order = $this->model->getById($id);
        if (!$order) {
            header("Location: index.php?act=order");
            exit;
        }
        $details = $this->model->getDetails($id);
        $view = "views/order/detail.php";
        include "layouts/main.php";
    }

    // cập nhật trạng thái (POST)
    function updateStatus() {
        $id = $_POST['id'] ?? 0;
        $status = $_POST['status'] ?? 0;
        $this->model->updateStatus($id, $status);
        header("Location: index.php?act=order-detail&id=" . (int)$id);
    }

    // xóa (soft)
    function delete() {
        $id = $_GET['id'] ?? 0;
        $this->model->delete($id);
        header("Location: index.php?act=order");
    }
}
