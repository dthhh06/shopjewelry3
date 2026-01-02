import { isEmpty, isEmail, isPhoneNumber } from "./config.js";

$(document).ready(function () {

    // Clear error khi input thay đổi
    $(".form-group input, .form-group textarea").on("input", function () {
        $(this).siblings(".error-message").text("");
    });

    $("button[name='place-order']").on("click", function (e) {
        e.preventDefault();

        const userId = $("input[name='userid']").data("userid");
        if (userId === "none") {
            Swal.fire({
                icon: "warning",
                title: "Chưa đăng nhập",
                text: "Bạn cần đăng nhập để đặt hàng!"
            });
            return;
        }

        let isValid = true;

        $(".form-group").each(function () {
            const inputField = $(this).find("input, textarea");
            const error = $(this).find(".error-message");

            if (inputField.length) {
                const val = inputField.val().trim();
                const name = inputField.attr("name");

                if (!val && name !== "note") {
                    error.text("Không được để trống");
                    isValid = false;
                } else if (inputField.attr("type") === "email" && !isEmail(val, error)) {
                    isValid = false;
                } else if (name === "phonenumber" && !isPhoneNumber(val, error)) {
                    isValid = false;
                }
            }
        });

        /*  CHECK RIÊNG ĐỊA CHỈ */
        const address = $("input[name='address']").val().trim();
        if (!address) {
            Swal.fire({
                icon: "error",
                title: "Thiếu địa chỉ",
                text: "Vui lòng nhập địa chỉ giao hàng trước khi đặt hàng!"
            });
            return;
        }

        if (!isValid) return;

        const selectedPayment = $("input[name='payment_method']:checked").val();
        $("#selected_payment").val(selectedPayment);

        /* ===== THANH TOÁN MOMO ===== */
        if (selectedPayment === "momo") {

            $.post("../includes/save_checkout_session.php", {
                fullname: $("input[name='fullname']").val(),
                email: $("input[name='email']").val(),
                phonenumber: $("input[name='phonenumber']").val(),
                address: address,
                district: $("input[name='district']").val(),
                province: $("input[name='province']").val(),
                note: $("textarea[name='note']").val()
            }, function () {

                Swal.fire({
                    icon: "success",
                    title: "Đang chuyển hướng",
                    text: "Bạn sẽ được chuyển sang cổng thanh toán MoMo...",
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = "../includes/momo_qr.php";
                });

            });

            return;
        }

        /* ===== COD ===== */
        Swal.fire({
            icon: "success",
            title: "Đặt hàng thành công",
            text: "Cảm ơn bạn đã đặt hàng!",
            confirmButtonText: "OK"
        }).then(() => {
            $(this).closest("form").submit();
        });
    });

    $("#homepage").on("click", function () {
        window.location.href = "../templates/trangchu.php";
    });
});
