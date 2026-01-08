// public/js/customerinfo.js

$(document).ready(function () {
  // Elements
  const btnGroup = $(".btns-group > .btn");
  const customerinfoContent = $(".customerinfo-content > div");
  const ordersTbody = $(".customerinfo__orders-tbody");
  const orderDetailsWrap = $(".customerinfo_orderdetails");

  // Format VND
  function formatVndPrice(price) {
    return Number(price).toLocaleString("it-IT", {
      style: "currency",
      currency: "VND",
    });
  }

  // Hàm trả về hiển thị trạng thái đơn hàng
  function getOrderStatusDisplay(order) {
    if (order.status == 0) {
      return `<span class="badge bg-warning text-dark">Đang xử lý</span>`;
    }

    const orderDateTime = new Date(order.order_date.replace(" ", "T"));
    const now = new Date();
    const hoursPassed = (now - orderDateTime) / (1000 * 60 * 60);

    if (hoursPassed >= 2) {
      return `<span class="badge bg-success">Giao thành công</span>`;
    } else {
      return `<span class="badge bg-info text-white">Đang giao</span>`;
    }
  }

  // Hàm trả về text thanh toán CHO CHI TIẾT ĐƠN (fix lỗi COD)
  function getPaymentStatusDisplay(paymentMethod, orderStatus, hoursPassed) {
    if (paymentMethod === "momo") {
      return `<span style="color:green;font-weight:600">Đã thanh toán (MoMo)</span>`;
    } else {
      // COD hoặc không có
      if (orderStatus == 1 && hoursPassed >= 2) {
        return `<span style="color:green;font-weight:600">Đã thanh toán (Khi nhận hàng)</span>`;
      } else {
        return `<span style="color:red;font-weight:600">Chưa thanh toán</span>`;
      }
    }
  }

  // Switch tab
  btnGroup.each(function () {
    $(this)
      .off("click")
      .on("click", function () {
        btnGroup.removeClass("active");
        $(this).addClass("active");

        const key = Object.keys($(this).data())[0];
        const elementOfLink = $(`.${key}`);

        customerinfoContent.removeClass("d-block").addClass("d-none");
        elementOfLink.removeClass("d-none").addClass("d-block");

        if ($(this).is("[data-customerinfo__orders]")) {
          renderOrders();
        }
      });
  });

  // ------------------ Render orders list ------------------
  async function fetchOrders() {
    try {
      const res = await fetch("../includes/customerorders.inc.php");
      if (!res.ok) throw new Error("Network response was not ok");
      const data = await res.json();
      return data;
    } catch (err) {
      console.error("fetchOrders error:", err);
      return [];
    }
  }

  async function renderOrders() {
    ordersTbody.html(`<tr><td colspan="6" class="text-center">Đang tải...</td></tr>`);

    const orders = await fetchOrders();

    if (!Array.isArray(orders) || orders.length === 0) {
      ordersTbody.html(`<tr><td colspan="6" class="text-center">Bạn chưa có đơn hàng nào</td></tr>`);
      return;
    }

    const rowsHtml = orders
      .map((order) => {
        const payment = order.payment_method || "";

        return `
          <tr class="order-row" 
              data-orderid="${order.id}"
              data-orderdate="${order.order_date}"
              data-orderaddress="${escapeHtml(order.address || '')}"
              data-ordertotal="${order.total_money}"
              data-payment="${payment}"
              data-status="${order.status}"
              style="cursor:pointer"
          >
            <td class="text-center">#${order.id}</td>
            <td class="text-center">${order.order_date}</td>
            <td class="text-center">${escapeHtml(order.address || "Không có")}</td>
            <td class="text-center">${formatVndPrice(order.total_money)}</td>
            <td class="text-center">${payment || "COD"}</td>
            <td class="text-center">${getOrderStatusDisplay(order)}</td>
          </tr>
        `;
      })
      .join("");

    ordersTbody.html(rowsHtml);

    $(".order-row").off("click").on("click", function () {
      const $tr = $(this);
      const value = {
        orderid: $tr.data("orderid"),
        orderdate: $tr.data("orderdate"),
        orderaddress: $tr.data("orderaddress"),
        ordertotal: $tr.data("ordertotal"),
        payment: $tr.data("payment"),
        status: $tr.data("status"),
      };
      handleSeeOrderDetails(value);
    });

    // Tự động refresh mỗi 30 giây nếu đang ở tab đơn hàng
    setTimeout(() => {
      if ($(".customerinfo__orders").hasClass("d-block")) {
        renderOrders();
      }
    }, 30000);
  }

  // ------------------ Escape HTML ------------------
  function escapeHtml(unsafe) {
    return String(unsafe)
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#039;");
  }

  // ------------------ Show order details ------------------
  function handleSeeOrderDetails(value) {
    $.ajax({
      type: "GET",
      url: "../includes/customerorderdetails.inc.php",
      data: {
        type: "getCustomerOrderDetails",
        orderid: value.orderid,
      },
      success: function (response) {
        let data;
        try {
          data = JSON.parse(response);
        } catch (e) {
          console.error("Invalid JSON:", e, response);
          orderDetailsWrap.html(`<div class="alert alert-danger">Lỗi khi tải chi tiết đơn hàng.</div>`);
          return;
        }

        const firstItem = data[0] || {};
        const orderDateTime = new Date(value.orderdate.replace(" ", "T"));
        const now = new Date();
        const hoursPassed = (now - orderDateTime) / (1000 * 60 * 60);

        const statusDisplay = getOrderStatusDisplay({ status: value.status, order_date: value.orderdate });
        const paymentStatus = getPaymentStatusDisplay(value.payment, value.status, hoursPassed);

        $(".customerinfo-content > div").addClass("d-none");
        orderDetailsWrap.removeClass("d-none");

        let html = `
          <button class="btn btn-outline-secondary mb-3 back-btn">← Quay lại danh sách đơn hàng</button>

          <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
            <h5>Chi tiết đơn hàng #${value.orderid}</h5>
            <div class="text-end">
              <p class="mb-0">Ngày đặt: ${value.orderdate}</p>
              <p class="mb-0"><strong>Trạng thái:</strong> ${statusDisplay}</p>
            </div>
          </div>

          <hr>

          <div class="row mb-4">
            <div class="col-md-6">
              <p><strong>Người nhận:</strong> ${escapeHtml(firstItem.fullname || "Không có")}</p>
              <p><strong>SĐT:</strong> ${escapeHtml(firstItem.phone_number || "Không có")}</p>
              <p><strong>Địa chỉ:</strong> ${escapeHtml(value.orderaddress || "Không có")}</p>
              <p><strong>Ghi chú:</strong> ${escapeHtml(firstItem.note || "Không có")}</p>
            </div>
            <div class="col-md-6 text-md-end">
              <p><strong>Phương thức thanh toán:</strong> ${paymentStatus}</p>
              <p><strong>Tổng tiền:</strong> <span style="font-size:1.2em;color:#d4af37">${formatVndPrice(value.ordertotal)}</span></p>
            </div>
          </div>

          <table class="table table-bordered">
            <thead class="table-light">
              <tr class="text-center">
                <th>Sản phẩm</th>
                <th>Đơn giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
              </tr>
            </thead>
            <tbody>
        `;

        if (!Array.isArray(data) || data.length === 0) {
          html += `<tr><td colspan="4" class="text-center">Không có sản phẩm</td></tr>`;
        } else {
          html += data
            .map((item) => {
              return `
                <tr class="text-center align-middle">
                  <td class="text-start">
                    ${item.thumbnail ? `<img src="${escapeHtml(item.thumbnail)}" style="width:80px;height:80px;object-fit:cover;border-radius:8px;" alt="">` : ''}
                    <span class="ms-3">${escapeHtml(item.title || 'Sản phẩm')}</span>
                  </td>
                  <td>${formatVndPrice(Number(item.orderdetail_price || 0))}</td>
                  <td>${item.num || 0}</td>
                  <td>${formatVndPrice(Number(item.total_money || 0))}</td>
                </tr>
              `;
            })
            .join("");
        }

        html += `</tbody></table>`;

        orderDetailsWrap.html(html);

        orderDetailsWrap.find(".back-btn").off("click").on("click", function () {
          orderDetailsWrap.addClass("d-none");
          $(".customerinfo__orders").removeClass("d-none").addClass("d-block");
          renderOrders();
        });
      },
      error: function () {
        orderDetailsWrap.html(`<div class="alert alert-danger">Lỗi tải chi tiết đơn hàng</div>`);
      },
    });
  }

  // Tab mặc định
  $(".btns-group > .btn").first().trigger("click");
});

// Preview avatar
document.getElementById("avatarInput")?.addEventListener("change", function(e) {
  const file = e.target.files[0];
  if (file) {
    document.getElementById("avatarPreview").src = URL.createObjectURL(file);
  }
});