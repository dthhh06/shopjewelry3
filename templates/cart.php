<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

<body>
    <div class="overlay d-none"></div>

    <div class="popupcart bg-white p-5 d-none">
        <div class="popuppanel">

            <div class="popuppanel__header mb-3">
                <i class="fa-solid fa-check" style="color: #d4af37; font-weight: 900; font-size: 20px"></i>
                <span id="popuppanel__header_title" style="font-weight: 900; font-size: 18px">
                    Bạn đã thêm <span style="color: #d4af37;"></span> vào giỏ hàng
                </span>
            </div>

            <div class="popuppanel__subheader mb-2">
                <i class="fa-solid fa-cart-shopping" style="color: #d4af37; font-weight: 900; font-size: 20px"></i>
                <a href="./SanPham.php" id="popuppanel__subheader_cart"></a>
            </div>

            <div style="max-height: 250px; overflow-y: scroll;" class="mb-3">
                <table class="popuppanel__table table border">
                    <thead class="sticky-top">
                        <tr style="background-color: #f7f7f7;">
                            <th style="font-size: 14px;" class="border">SẢN PHẨM</th>
                            <th style="font-size: 14px;" class="border text-center">ĐƠN GIÁ</th>
                            <th style="font-size: 14px;" class="border text-center">SỐ LƯỢNG</th>
                            <th style="font-size: 14px;" class="border text-center">THÀNH TIỀN</th>
                        </tr>
                    </thead>
                    <tbody class="product_in_cart"></tbody>
                </table>
            </div>

            <div class="popuppanel__bottom d-flex align-items-center justify-content-between mb-4">
                <div class="popuppanel__bottom-left" style="font-size: 14px;">
                    <p class="mb-0">Giao hàng trên toàn quốc</p>
                    <a href="SanPham.php" style="font-size: 16px; font-weight:700; color:#d4af37 !important; text-decoration:underline;">
                        ← Tiếp tục mua hàng
                    </a>
                </div>
                <div class="popuppanel__bottom-right text-end">
                    <p class="mb-0">Thành tiền:</p>
                    <p style="color:#d4af37; font-weight:700; font-size:22px;" id="total_or_order">0₫</p>
                </div>
            </div>

            <!-- NÚT TIẾN HÀNH ĐẶT HÀNG -->
            <button type="button" name="btn-placeorder" class="btn btn-primary">TIẾN HÀNH ĐẶT HÀNG</button>

            <button type="button" class="cart-close-btn btn btn-outline-secondary">
                <i class="fa-solid fa-xmark me-2"></i>Đóng giỏ hàng
            </button>

        </div>
    </div>

    <!-- JS CHỈ ĐỂ ĐÓNG BẰNG CLASS MỚI -->
    <script>
        $(document).ready(function() {
            // Dùng class mới hoàn toàn riêng biệt
            $(".cart-close-btn").on("click", function() {
                $(".popupcart, .overlay").addClass("d-none");
            });

            // Vẫn giữ overlay đóng được
            $(".overlay").on("click", function() {
                $(".popupcart, .overlay").addClass("d-none");
            });
        });
    </script>
</body>