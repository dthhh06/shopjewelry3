<h1 class="mt-4">Dashboard</h1>
<p>Chào mừng bạn đến trang quản trị!</p>

<div class="row">

    <!-- Doanh thu hôm nay -->
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body">
                Doanh thu hôm nay
                <h3><?= number_format($todayRevenue) ?> đ</h3>
            </div>
        </div>
    </div>

    <!-- Doanh thu tuần -->
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white mb-4">
            <div class="card-body">
                Doanh thu tuần này
                <h3><?= number_format($weekRevenue) ?> đ</h3>
            </div>
        </div>
    </div>

    <!-- Doanh thu tháng -->
    <div class="col-xl-3 col-md-6">
        <div class="card bg-warning text-white mb-4">
            <div class="card-body">
                Doanh thu tháng này
                <h3><?= number_format($monthRevenue) ?> đ</h3>
            </div>
        </div>
    </div>

    <!-- Tổng đơn hàng -->
    <div class="col-xl-3 col-md-6">
        <div class="card bg-danger text-white mb-4">
            <div class="card-body">
                Tổng đơn hàng
                <h3><?= $totalOrders ?></h3>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="order_list.php">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>

</div>

<div class="row mt-4">

    <!-- Tổng danh mục -->
    <div class="col-xl-6 col-md-6">
        <div class="card border-left-dark mb-4 shadow">
            <div class="card-body">
                Tổng danh mục
                <h3><?= $totalCategories ?></h3>
            </div>
        </div>
    </div>

    <!-- Tổng số lượng bán theo danh mục -->
    <div class="col-xl-6 col-md-6">
        <div class="card border-left-primary mb-4 shadow">
            <div class="card-body">
                Tổng số lượng bán theo danh mục
                <ul>
                    <?php while($row = $totalSoldByCategory->fetch_assoc()): ?>
                        <li><?= $row['category_name'] ?>: <?= $row['total_sold'] ?> cái</li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>
    </div>

</div>

<hr/>

<!-- BIỂU ĐỒ -->
<div class="row mt-4">
    <div class="col-lg-6">
        <div class="card mb-4">
            <div class="card-header">Doanh thu theo tháng</div>
            <div class="card-body">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card mb-4">
            <div class="card-header">Số lượng bán theo danh mục</div>
            <div class="card-body">
                <canvas id="categoryChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    // Biểu đồ doanh thu
    const revenueData = {
        labels: [<?php while($r = $revenueChart->fetch_assoc()) echo '"' . $r['month'] . '",'; ?>],
        datasets: [{
            label: "Doanh thu",
            data: [<?php
                mysqli_data_seek($revenueChart,0);
                while($r2 = $revenueChart->fetch_assoc()) echo $r2['revenue'] . ',';
            ?>],
            borderColor: "blue",
            borderWidth: 2
        }]
    };
    new Chart(document.getElementById("revenueChart"), { type: "line", data: revenueData });

    // Biểu đồ số lượng theo danh mục
    const categoryData = {
        labels: [<?php
            mysqli_data_seek($categorySales,0);
            while($c = $categorySales->fetch_assoc()) echo '"' . $c['category_name'] . '",';
        ?>],
        datasets: [{
            label: "Số lượng bán",
            data: [<?php
                mysqli_data_seek($categorySales,0);
                while($cs = $categorySales->fetch_assoc()) echo $cs['total_sold'] . ',';
            ?>],
            backgroundColor: ['red','blue','green','orange','purple']
        }]
    };
    new Chart(document.getElementById("categoryChart"), { type: "bar", data: categoryData });
});
</script>
