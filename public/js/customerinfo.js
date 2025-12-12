// public/js/customerinfo.js
// Nếu project của bạn dùng module imports (ví dụ config.js), giữ import.
// Nếu không, bạn có thể bỏ import dòng dưới.
// import { isEmpty, isCorrectVerifyPassword } from "./config.js";

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

  // Switch tab
  btnGroup.each(function () {
    $(this)
      .off("click")
      .on("click", function () {
        btnGroup.removeClass("active");
        $(this).addClass("active");

        const key = Object.keys($(this).data())[0]; // ex: customerinfo__orders
        const elementOfLink = $(`.${key}`);

        customerinfoContent.removeClass("d-block").addClass("d-none");
        elementOfLink.removeClass("d-none").addClass("d-block");

        // If orders tab opened, load orders
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
        const statusText =
          payment === "momo"
            ? `<span class="text-success fw-bold">Đã thanh toán</span>`
            : `<span class="text-danger fw-bold">Chưa thanh toán</span>`;

        return `
          <tr class="order-row" 
              data-orderid="${order.id}"
              data-orderdate="${order.order_date}"
              data-orderaddress="${escapeHtml(order.address || '')}"
              data-ordertotal="${order.total_money}"
              data-payment="${payment}"
              style="cursor:pointer"
          >
            <td class="text-center">#${order.id}</td>
            <td class="text-center">${order.order_date}</td>
            <td class="text-center">${escapeHtml(order.address || "Không có")}</td>
            <td class="text-center">${formatVndPrice(order.total_money)}</td>
            <td class="text-center">${payment || "Không có"}</td>
            <td class="text-center">${statusText}</td>
          </tr>
        `;
      })
      .join("");

    ordersTbody.html(rowsHtml);

    // attach click
    $(".order-row").off("click").on("click", function () {
      const $tr = $(this);
      const value = {
        orderid: $tr.data("orderid"),
        orderdate: $tr.data("orderdate"),
        orderaddress: $tr.data("orderaddress"),
        ordertotal: $tr.data("ordertotal"),
        payment: $tr.data("payment"),
      };
      handleSeeOrderDetails(value);
    });
  }

  // ------------------ Escape HTML (prevent XSS from DB text) ------------------
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
    // call API to get details
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
          console.error("Invalid JSON from order details:", e, response);
          orderDetailsWrap.html(`<div class="alert alert-danger">Lỗi khi tải chi tiết đơn hàng.</div>`);
          return;
        }

        // hide other sections, show detail
        $(".customerinfo-content > div").addClass("d-none");
        orderDetailsWrap.removeClass("d-none");

        const paymentStatus = value.payment === "momo"
          ? `<span style="color:green;font-weight:600">Đã thanh toán (MoMo)</span>`
          : `<span style="color:red;font-weight:600">Chưa thanh toán</span>`;

        let html = `
          <button class="btn btn-outline-secondary mb-3 back-btn">← Quay lại</button>

          <div class="d-flex align-items-center justify-content-between">
            <h5>Chi tiết đơn hàng #${value.orderid}</h5>
            <p>Ngày tạo: ${value.orderdate}</p>
          </div>

          <div class="mb-2">
            <p class="mb-1"><strong>Địa chỉ giao:</strong> ${escapeHtml(value.orderaddress || "Không có")}</p>
            <p class="mb-1"><strong>Thanh toán:</strong> ${paymentStatus}</p>
            <p class="mb-1"><strong>Tổng đơn:</strong> ${formatVndPrice(value.ordertotal)}</p>
          </div>

          <table class="table table-bordered">
            <thead>
              <tr class="text-center">
                <th>Sản phẩm</th>
                <th>Đơn giá</th>
                <th>Số lượng</th>
                <th>Tổng</th>
              </tr>
            </thead>
            <tbody>
        `;

        if (!Array.isArray(data) || data.length === 0) {
          html += `<tr><td colspan="4" class="text-center">Không có sản phẩm</td></tr>`;
        } else {
          html += data
            .map((item) => {
              // Fields expected from model: thumbnail, title, orderdetail_price, num, total_money
              return `
                <tr class="text-center">
                  <td class="text-start">
                    <img src="${escapeHtml(item.thumbnail || '')}" style="width:80px;height:80px;object-fit:cover" alt="">
                    <span class="ms-2">${escapeHtml(item.title || '')}</span>
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

        // back button
        orderDetailsWrap.find(".back-btn").off("click").on("click", function () {
          orderDetailsWrap.addClass("d-none");
          $(".customerinfo__orders").removeClass("d-none");
        });
      },
      error: function (xhr, status, err) {
        console.error("AJAX error:", err);
        orderDetailsWrap.html(`<div class="alert alert-danger">Lỗi tải chi tiết đơn hàng</div>`);
      },
    });
  }

  // Initially: show account info by default
  $(".btns-group > .btn").first().trigger("click");
});

document.getElementById("avatarInput").addEventListener("change", function(e) {
    const file = e.target.files[0];
    if (file) {
        document.getElementById("avatarPreview").src = URL.createObjectURL(file);
    }
});