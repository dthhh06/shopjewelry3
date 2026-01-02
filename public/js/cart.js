$(document).ready(function () {
  // =================================== CÁC HÀM HỖ TRỢ ===================================


  function formatVndPrice(price) {
    return price.toLocaleString("it-IT", { style: "currency", currency: "VND" });
  }

  // Render lại toàn bộ giỏ hàng từ danh sách sản phẩm nhận được từ server
  function renderCart(productList, highlightProductId = null) {
    const $productInCart = $(".product_in_cart");
    const $subheaderCart = $("#popuppanel__subheader_cart");
    const $totalOrder = $("#total_or_order");
    const $quantityBadge = $(".quantity");

    if (!productList || productList.length === 0) {
      $productInCart.html(
        '<tr><td colspan="4" class="text-center">Không có sản phẩm nào trong giỏ hàng. Quay lại <a href="../templates/SanPham.php" style="color: #d4af37">cửa hàng</a> để tiếp tục mua sắm.</td></tr>'
      );
      $subheaderCart.text("Giỏ hàng của bạn (0) sản phẩm");
      $totalOrder.text("0₫");
      $quantityBadge.text("0");
      return;
    }

    let totalOrder = 0;
    let totalProducts = 0;

    const rows = productList.map((product) => {
      const totalPrice = Number(product.price) * Number(product.customer_quantity);
      totalOrder += totalPrice;
      totalProducts += Number(product.customer_quantity);

      const isNew = highlightProductId && product.id === highlightProductId;

      return `
        <tr data-productid="${product.id}">
          <td class="d-flex align-items-start">
            <img src="${product.thumbnail}" alt="" class="img-responsive border" style="width: 80px">
            <div class="d-inline-flex flex-column justify-content-start align-items-start ms-2">
              <span style="font-size: 14px; font-weight: 600; color: #d4af37;" class="mb-2">${product.title}</span>
              <span style="font-size: 12px; font-weight: 500; color: #aaa; cursor: pointer" class="remove-product">
                <i class="fa-solid fa-close me-1 mb-2" style="font-weight: 900; font-size: 14px"></i>Bỏ sản phẩm
              </span>
              ${isNew ? '<span style="color: #898989; font-size: 14px"><i class="fa-solid fa-check me-1" style="color: #d4af37; font-weight: 900; font-size: 14px"></i>Sản phẩm vừa thêm!</span>' : ""}
            </div>
          </td>
          <td class="text-center product-price" data-productprice="${product.price}" style="font-size: 14px; font-weight: 600; color: #d4af37;">
            ${formatVndPrice(Number(product.price))}
          </td>
          <td class="text-center">
            <div>
              <button type="button" class="minus">-</button>
              <input type="number" name="quantity" disabled style="min-width: 50px;" value="${product.customer_quantity}">
              <button type="button" class="plus">+</button>
            </div>
            <div class="text-muted in-stock" style="font-size: 12px;" data-instock="${product.quantity}">
              In stock: ${product.quantity}
            </div>
          </td>
          <td class="text-center total-price" style="font-size: 14px; font-weight: 600; color: #d4af37;">
            ${formatVndPrice(totalPrice)}
          </td>
        </tr>`;
    }).join("");

    $productInCart.html(rows);
    $subheaderCart.text(`Giỏ hàng của bạn (${totalProducts}) sản phẩm`);
    $totalOrder.text(formatVndPrice(totalOrder));
    $quantityBadge.text(totalProducts);

    attachQuantityEvents();
    attachRemoveEvents();
  }

  // Gắn sự kiện cho nút +/- và input số lượng
  function attachQuantityEvents() {
    $(".plus").off("click").on("click", function () {
      const $input = $(this).siblings("input[name='quantity']");
      const newVal = Number($input.val()) + 1;
      $input.val(newVal);
      updateRowTotal($(this));
      updateCartQuantity($(this).closest("tr"), newVal);
    });

    $(".minus").off("click").on("click", function () {
      const $input = $(this).siblings("input[name='quantity']");
      const newVal = Math.max(1, Number($input.val()) - 1);
      $input.val(newVal);
      updateRowTotal($(this));
      updateCartQuantity($(this).closest("tr"), newVal);
    });

    $("input[name='quantity']").off("input").on("input", function () {
      let val = Number($(this).val()) || 1;
      if (val < 1) val = 1;
      $(this).val(val);
      updateRowTotal($(this));
      updateCartQuantity($(this).closest("tr"), val);
    });
  }

  // Gắn sự kiện xóa sản phẩm
  function attachRemoveEvents() {
    $(".remove-product").off("click").on("click", function () {
      const $row = $(this).closest("tr");
      removeFromCart($row);
    });
  }

  // Cập nhật thành tiền của dòng
  function updateRowTotal(element) {
    const $row = element.closest("tr");
    const price = Number($row.find(".product-price").data("productprice"));
    const qty = Number($row.find("input[name='quantity']").val());
    $row.find(".total-price").text(formatVndPrice(price * qty));
  }

  // Mở popup giỏ hàng
  function openCartPopup() {
    $(".popupcart, .overlay").removeClass("d-none").addClass("d-block");
  }

  // Đóng popup giỏ hàng
  function closeCartPopup() {
    $(".popupcart, .overlay").removeClass("d-block").addClass("d-none");
  }

  // =================================== CÁC HÀNH ĐỘNG CHÍNH ===================================

  // Nút tiến hành đặt hàng
  $("button[name='btn-placeorder']").off("click").on("click", () => {
    window.location.href = "../templates/payment.php";
  });

  // Thêm sản phẩm vào giỏ (từ nút hoặc ảnh sản phẩm)
  $(".product-item .product-img, button[name='add_product_to_cart']").off("click").on("click", function () {
    let productId = null;
    if ($(this).hasClass("product-img")) {
      productId = $(this).closest(".product-item").data("productid");
    } else {
      productId = $(this).closest(".productdetail-item").data("productid");
    }

    if (productId) {
      addToCart(productId);
      openCartPopup();
    }
  });

  // Mở giỏ hàng khi click icon giỏ hàng
  $(".shoppingcart").off("click").on("click", function () {
    openCartPopup();
    loadCart(); // load lại để chắc chắn dữ liệu mới nhất
  });

  // Đóng popup
  $(document).on("click", ".cart-close-btn, .overlay", closeCartPopup);

  // =================================== AJAX FUNCTIONS ===================================

  // Thêm sản phẩm
  function addToCart(productId) {
    $.post("../includes/cart.inc.php", { productId, type: "addToCart" }, function (response) {
      if (response) {
        const productList = Object.values(JSON.parse(response));
        const newProduct = productList.find(p => p.id === productId);
        $("#popuppanel__header_title > span").text(newProduct.title);
        renderCart(productList, productId);
      }
    });
  }

  // Xem giỏ hàng
  function loadCart() {
    $.get("../includes/seeProductInCart.inc.php", function (response) {
      if (response && response !== "none") {
        const productList = Object.values(JSON.parse(response));
        renderCart(productList);
      } else {
        renderCart([]);
      }
    });
  }

  // Xóa sản phẩm
  function removeFromCart($row) {
    const productId = $row.data("productid");
    $.post("../includes/cart.inc.php", { productId, type: "removeFromCart" }, function (response) {
      if (response && response !== "0") {
        const productList = Object.values(JSON.parse(response));
        renderCart(productList);
      }
    });
  }

  // Thay đổi số lượng
  function updateCartQuantity($row, newQuantity) {
    const productId = $row.data("productid");
    const $input = $row.find("input[name='quantity']");
    const stock = Number($row.find(".in-stock").data("instock"));

    // Disable nút + nếu đạt stock
    if (newQuantity >= stock) {
      $row.find(".plus").attr("disabled", "disabled");
      $input.val(stock);
      newQuantity = stock;
    } else {
      $row.find(".plus").removeAttr("disabled");
    }

    $.post("../includes/cart.inc.php", { productId, customer_quantity: newQuantity, type: "changeQuantity" }, function (response) {
      if (response) {
        const productList = Object.values(JSON.parse(response));
        if (newQuantity == 0) {
          renderCart(productList);
        } else {
          renderCart(productList);
        }
      }
    });
  }
});