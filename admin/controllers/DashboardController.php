<?php
require "models/DashboardModel.php";

class DashboardController {
    private $model;

    function __construct($db) {
        $this->model = new DashboardModel($db);
    }

    function index() {
        $todayRevenue = $this->model->getTodayRevenue();
        $weekRevenue = $this->model->getWeekRevenue();
        $monthRevenue = $this->model->getMonthRevenue();
        $totalOrders = $this->model->getTotalOrders();
        $totalCategories = $this->model->getTotalCategories();

        $revenueChart = $this->model->getRevenueChart();
        $categorySales = $this->model->getCategorySales();
        $totalSoldByCategory = $this->model->getTotalSoldByCategory(); // mới thêm

        $view = "views/dashboard.php";
        include "layouts/main.php";
    }
}
