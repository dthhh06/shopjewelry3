<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">

                <a class="nav-link" href="index.php?act=dashboard">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                <a class="nav-link" href="index.php?act=products">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-database"></i></div>
                    Sản phẩm
                </a>

                <a class="nav-link" href="index.php?act=category">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-tags"></i></div>
                    Danh mục
                </a>

                <a class="nav-link" href="index.php?act=users">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                    Người dùng
                </a>

                <!-- MENU VAI TRÒ & PHÂN QUYỀN - ACTIVE TỰ ĐỘNG -->
                <a class="nav-link <?php echo (isset($_GET['act']) && strpos($_GET['act'], 'role') === 0) ? 'active' : ''; ?>"
                    href="index.php?act=role">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-shield-halved"></i></div>
                    Vai trò
                </a>

                <!-- PHÂN NHÓM GIAO DỊCH -->
                <div class="sb-sidenav-menu-heading text-muted small mt-4">Giao dịch</div>

                <a class="nav-link" href="index.php?act=order">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-file-invoice"></i></div>
                    Đơn hàng
                </a>

                <a class="nav-link" href="index.php?act=supplier">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-truck"></i></div>
                    Nhà cung cấp
                </a>

                <a class="nav-link" href="index.php?act=import">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-file-invoice-dollar"></i></div>
                    Phiếu nhập hàng
                </a>

                <a href="index.php?act=stock" class="nav-link">
                    <div class="sb-nav-link-icon"><i class="fas fa-warehouse"></i></div>
                    Kho hàng
                </a>

                <!-- PHÂN NHÓM NỘI DUNG -->
                <div class="sb-sidenav-menu-heading text-muted small mt-4">Nội dung</div>

                <a class="nav-link" href="index.php?act=galleries">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-images"></i></div>
                    Thư viện ảnh
                </a>

                <a class="nav-link" href="index.php?act=contact">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-envelope"></i></div>
                    Feedback
                </a>

                <hr class="sidebar-divider my-4">

                <!-- ĐĂNG XUẤT DÙNG SWEETALERT2 -->
                <a class="nav-link text-danger" href="#" id="logoutLink">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-right-from-bracket"></i></div>
                    Đăng xuất
                </a>

            </div>
        </div>
    </nav>
</div>

<!-- Script SweetAlert2 cho Đăng xuất -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('logoutLink').addEventListener('click', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Bạn có chắc chắn muốn đăng xuất?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Đăng xuất',
            cancelButtonText: 'Hủy',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '../includes/logout.inc.php';
            }
        });
    });
</script>