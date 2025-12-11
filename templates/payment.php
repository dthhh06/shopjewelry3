<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Payment</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../public/assets/css/config.css">
    <link rel="stylesheet" href="../public/assets/css/payment.css">

    <!-- JQUERY -->
    <script src="../public/assets/libs/jquery-3.7.1.min.js"></script>

    <!-- Js -->
    <script type="module" defer src="../public/js/payment.js"></script>

    <!-- Fontawesome -->
    <link rel="stylesheet" href="../public/assets/icons/css/all.min.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    

    <?php
    if (session_status() == PHP_SESSION_NONE) session_start();

    $productList = $_SESSION["cart"] ?? [];
    $totalOfOrder = 0;
    foreach ($productList as $product) {
        $totalOfOrder += intval($product['customer_quantity']) * intval($product['price']);
    }
    $totalOfOrderHasFee = $totalOfOrder + 40000;
    $vndTotalOfOrderHasFee = number_format($totalOfOrderHasFee, 0, '', ',') . ' VND';
    $vndTotalOfOrder = number_format($totalOfOrder, 0, '', ',') . ' VND';
    ?>
</head>

<body>
    <input type="hidden" name="userid" data-userid="<?php echo $_SESSION['id'] ?? 'none'; ?>">

    <form action="../includes/payment.inc.php" method="POST" class="main">
        <div class="container-fluid">
            <div class="row ps-5" style="height: 100vh;">
                <div class="col-lg-8 col-md-8 mt-4">
                    <a href="./trangchu.php" class="logo"><i class="fas fa-gem"></i> Aurelia</a>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 me-4">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span style="font-size: 18px; font-weight: 600;">Thông tin nhận hàng</span>
                                <a href="../templates/login.php" style="color: #d4af37;"><i class="fa-solid fa-user"></i> Đăng nhập</a>
                            </div>
                            <div class="row">
                                <input type="hidden" name="userid" value="<?php echo $_SESSION['id'] ?? ''; ?>">

                                <div class="form-group ps-0">
                                    <input type="email" name="email" class="form-control" placeholder="Email *" value="<?php echo $_SESSION['useremail'] ?? ''; ?>">
                                    <div class="error-message"></div>
                                </div>
                                <div class="form-group ps-0">
                                    <input type="text" name="fullname" class="form-control" placeholder="Full name *" value="<?php echo $_SESSION['fullname'] ?? ''; ?>">
                                    <div class="error-message"></div>
                                </div>
                                <div class="form-group ps-0">
                                    <input type="text" name="phonenumber" class="form-control" placeholder="Phone number *" value="<?php echo $_SESSION['phone_number'] ?? ''; ?>">
                                    <div class="error-message"></div>
                                </div>
                                <div class="form-group ps-0">
                                    <input type="text" name="province" class="form-control" placeholder="Province *">
                                    <div class="error-message"></div>
                                </div>
                                <div class="form-group ps-0">
                                    <input type="text" name="district" class="form-control" placeholder="District *">
                                    <div class="error-message"></div>
                                </div>
                                <div class="form-group ps-0">
                                    <input type="text" name="address" class="form-control" placeholder="Address *">
                                    <div class="error-message"></div>
                                </div>
                                <div class="form-group ps-0">
                                    <textarea name="note" class="form-control" placeholder="Note (Optional)"></textarea>
                                    <div class="error-message"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-5 col-md-5">
                            <p style="font-size: 18px; font-weight: 600;">Thanh toán</p>

                            <div class="payment-option form-control p-3 d-flex align-items-center justify-content-between">
                                <span class="d-flex align-items-center">
                                    <input type="radio" name="payment_method" value="cod" checked style="width: 20px; height: 18px;">
                                    <label class="ms-2">Cash on Delivery (COD)</label>
                                </span>
                                <i class="fa-solid fa-money-bill-1-wave" style="color:#d4af37; font-size: 20px;"></i>
                            </div>

                            <div class="payment-option form-control p-3 d-flex align-items-center justify-content-between">
                                <span class="d-flex align-items-center">
                                    <input type="radio" name="payment_method" value="momo" style="width: 20px; height: 18px;">
                                    <label class="ms-2">Thanh toán MoMo</label>
                                </span>
                                <img src="https://upload.wikimedia.org/wikipedia/vi/f/fe/MoMo_Logo.png" width="32">
                            </div>

                            <div class="payment-option form-control p-3 d-flex align-items-center justify-content-between">
                                <span class="d-flex align-items-center">
                                    <input type="radio" name="payment_method" value="vnpay" style="width: 20px; height: 18px;">
                                    <label class="ms-2">Thanh toán VNPay</label>
                                </span>
                                <img src="../assets/imgs/brand/vnpay.png" width="32">
                            </div>

                            <!-- Hidden input để gửi phương thức -->
                            <input type="hidden" name="selected_payment" id="selected_payment">
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 border-start pe-5" style="background-color: #fafafa;">
                    <div class="row border-bottom ps-4 py-3" style="font-size: 20px; font-weight: 700">
                        Order (<?php echo count($productList); ?> product(s))
                    </div>

                    <div class="ps-4">
                        <div class="row py-3 border-bottom mb-3" style="max-height: calc(100vh - 480px); overflow-y: scroll;">
                            <?php foreach ($productList as $product) { ?>
                                <div class="p-0 d-flex justify-content-between align-items-center mb-2" data-productid="<?php echo $product['id']; ?>">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="me-1">
                                            <img src="<?php echo $product['thumbnail']; ?>" class="border rounded-3" width="50" height="50">
                                            <span>(<?php echo $product['customer_quantity']; ?>)</span>
                                        </div>
                                        <span style="text-overflow:ellipsis; overflow:hidden; white-space:nowrap; width: 150px; display: inline-block;">
                                            <?php echo $product['title']; ?>
                                        </span>
                                    </div>
                                    <div><?php echo number_format($product['price'], 0, '', ',') . ' VND'; ?></div>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="row pb-3 border-bottom mb-3">
                            <div class="calculate_temp d-flex justify-content-between align-items-center mb-1 text-muted">
                                <span>Provisional</span>
                                <span><?php echo $vndTotalOfOrder; ?></span>
                            </div>
                            <div class="delivery_fee d-flex justify-content-between align-items-center text-muted">
                                <span>Delivery fee</span>
                                <span>40,000 VND</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="total_order  d-flex justify-content-between align-items-center text-muted">
                                <span style="font-size: 18px;">Total</span>
                                <span style="color: #d4af37; font-size: 22px; font-weight: 600"><?php echo $vndTotalOfOrderHasFee; ?></span>
                            </div>
                        </div>

                        <div class="row pb-3 mb-3">
                            <div class="back_to_cart d-flex justify-content-between align-items-center">
                                <a href="./SanPham.php" style="color: #d4af37;">Back to shop</a>
                                <button type="button" name="place-order" class="btn btn-primary">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        $(document).ready(function () {
            $("button[name='place-order']").on("click", function (e) {
                e.preventDefault();

                const userId = $("input[name='userid']").data("userid");
                if (userId === "none") {
                    alert("Log in to place the order");
                    return false;
                }

                // set giá trị hidden input
                const selected = $("input[name='payment_method']:checked").val();
                $("#selected_payment").val(selected);

                // kiểm tra nếu momo hoặc vnpay → redirect
                if (selected === "momo") {
                    window.location.href = "../includes/momo_atm.php";
                    return;
                } else if (selected === "vnpay") {
                    window.location.href = "../includes/vnpay.php";
                    return;
                }

                // COD → submit form bình thường
                $(this).closest("form").submit();
            });
        });
    </script>

</body>
</html>
