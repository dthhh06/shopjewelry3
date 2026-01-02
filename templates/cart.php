<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
<style>
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); 
        z-index: 1040; 
        display: none; 
    }
    .popupcart {
        position: fixed;
        top: 60%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 90%;
        max-width: 900px; 
        height: 550px;
        z-index: 1050; 
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        display: none; 
    }
    .popupcart:not(.d-none) {
        display: block !important;
    }

    .overlay:not(.d-none) {
        display: block !important;
    }

    .popuppanel__table thead th {
        background-color: #f7f7f7 !important;
    } 
.container-top {
  padding-left: 10px;
}

.breadcrumb {
  display: flex;
  align-items: center;
  margin-top: 1px;

  font-size: 14px;
  color: #666;
}

.breadcrumb-item {
  color: #333;
  text-decoration: none;
}

.breadcrumb-item:hover {
  color: #000;
}

.breadcrumb-separator {
  margin: 0 8px;
}
.cart {
  padding: 0 40px;
}

.cart-content-left {
  flex: 2;
  padding-right: 12px;
}
.cart-content-left table {
  width: 100%;
  text-align: center;
}
.cart-content-left table th {
  padding-bottom: 1%;
  font-family: var(--main-text-font);
  font-size: 12px;
  text-transform: uppercase;
  color: #333;
  border-collapse: collapse;
  border-bottom: 2px solid #ddd;
}
.cart-content-left table p {
  font-family: var(--main-text-font);
  font-size: 18px;
  color: #333;
  margin: 0;
}
.cart-content-left table input {
  width: 30px;
}
.cart-content-left table button {
  width: 20px;
  height: 20px;
  border: 1px solid;
  cursor: pointer;
}
.cart-content-left table td {
  padding: 20px 0;
  text-align: center;
  border-bottom: 2px solid #ddd;
}
.cart-content-left table td:first-child img {
  width: 150px;
}
.cart-content-left table td:first-child(2) {
  max-width: 120px;
}
.cart-content-left table td:first-child(3) {
  width: 30px;
}
.cart-content-left table td:first-child(5) {
  text-align: center;
}
.cart-content-right {
  flex: 1;
  padding-left: 12px;
  border-left: 2px solid #ddd;
}
.cart-content-right table {
  width: 100%;
  margin-bottom: 20px;
}
.cart-content-right table th {
  padding-bottom: 30px;
  font-family: var(--main-text-font);
  font-size: 18px;
  color: #333;
  border-collapse: collapse;
  border-bottom: 2px solid #ddd;
}
.cart-content-right table td {
  font-family: var(--main-text-font);
  font-size: 18px;
  color: #333;
  padding: 6px 0;
}
.cart-content-right tr:nth-child(1) {
  text-align: center;
}
.cart-content-right table p {
  margin: 0;
}
.cart-content-right tr:nth-child(4) td {
  border-bottom: 2px solid #ddd;
}

.cart-content-right tr td:last-child {
  text-align: right;
}
.cart-content-right-button {
  text-align: center;
  align-items: center;
}
.cart-content-right-button button {
  padding: 0 5px;
  height: 35px;
  cursor: pointer;
  margin: 0 5px;
}
.cart-content-right-button button:first-child {
  background-color: #fff;
  border: 2px solid black;
  font-weight: bold;
}
.cart-content-right-button button:last-child {
  background-color: #d4b786;
  color: #fff;
  font-weight: bold;
  border: none;
}
</style>
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
            <button type="button" name="btn-placeorder" class="btn">TIẾN HÀNH ĐẶT HÀNG</button>
        </div>
    </div>

    <script>
        
        $(document).ready(function() {
            // // Dùng class mới hoàn toàn riêng biệt
            // $(".cart-close-btn").on("click", function() {
            //     $(".popupcart, .overlay").addClass("d-none");
            // });

            // Vẫn giữ overlay đóng được
            $(".overlay").on("click", function() {
                $(".popupcart, .overlay").addClass("d-none");
            });
        });
    </script>
</body>