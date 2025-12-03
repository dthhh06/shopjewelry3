import { isEmpty, isEmail, isPhoneNumber } from "./config.js";

$(document).ready(function () {
    // Clear error khi input thay đổi
    $(".form-group input, .form-group textarea").on("input", function () {
        $(this).siblings(".error-message").text("");
    });

    // Khi nhấn nút PLACE ORDER
    $("button[name='place-order']").on("click", function (e) {
        e.preventDefault();

        const userId = $("input[name='userid']").data("userid");
        if (userId === "none") {
            alert("Bạn cần đăng nhập để đặt hàng!");
            return;
        }

        let isValid = true;

        $(".form-group").each(function () {
            const inputField = $(this).find("input, textarea");
            const error = $(this).find(".error-message");

            if (inputField.length) {
                const val = inputField.val().trim();

                if (!val && inputField.attr("name") !== "note") {
                    error.text("Không được để trống");
                    isValid = false;
                } else if (inputField.attr("type") === "email" && !isEmail(val, error)) {
                    isValid = false;
                } else if (inputField.attr("name") === "phonenumber" && !isPhoneNumber(val, error)) {
                    isValid = false;
                }
            }
        });

        if (!isValid) return;

        // Lấy phương thức thanh toán
        const selectedPayment = $("input[name='payment_method']:checked").val();
        $("#selected_payment").val(selectedPayment);

        // Redirect MoMo / VNPay
        if (selectedPayment === "momo") {
            window.location.href = "../includes/momo_atm.php";
            return;
        } else if (selectedPayment === "vnpay") {
            window.location.href = "../includes/vnpay.php";
            return;
        }

        // COD → submit form bình thường
        $(this).closest("form").submit();
    });

    // Nút quay về trang chủ (nếu có)
    $("#homepage").on("click", function () {
        window.location.href = "../templates/trangchu.php";
    });
});
