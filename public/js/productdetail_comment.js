// === productdetail_comment.js ===
if (window.commentScriptLoaded) {
    // Nếu file JS đã chạy trước đó thì dừng (tránh gắn event 2 lần)
    console.log("Comment script already loaded — abort duplicate init.");
} else {
    window.commentScriptLoaded = true;

    document.addEventListener("DOMContentLoaded", function () {

        const section = document.getElementById("commentsSection");
        if (!section) return;
        const productId = section.getAttribute("data-product-id");

        const stars = document.querySelectorAll(".rating-stars i");
        const ratingInput = document.getElementById("ratingInput");
        const commentBox = document.getElementById("commentText");
        const submitBtn = document.getElementById("submitComment");
        const commentList = document.getElementById("commentList");

        let selectedRating = 0;
        let isSending = false;
        let lastXhr = null; // có thể abort nếu cần

        // Hover + click stars
        stars.forEach((star, index) => {
            star.addEventListener("mouseenter", () => {
                stars.forEach(s => s.classList.remove("hovered"));
                for (let i = 0; i <= index; i++) stars[i].classList.add("hovered");
            });
            star.addEventListener("mouseleave", () => {
                stars.forEach(s => s.classList.remove("hovered"));
            });
            star.addEventListener("click", () => {
                selectedRating = index + 1;
                ratingInput.value = selectedRating;
                stars.forEach(s => s.classList.remove("selected"));
                for (let i = 0; i < selectedRating; i++) stars[i].classList.add("selected");
            });
        });

        // Gửi bình luận
        submitBtn.addEventListener("click", function () {

            if (isSending) {
                console.log("Request already in flight — blocked.");
                return;
            }

            let rating = selectedRating;
            let comment = commentBox.value.trim();

            if (rating === 0) {
                alert("Vui lòng chọn số sao!");
                return;
            }
            if (comment.length === 0) {
                alert("Vui lòng nhập bình luận!");
                return;
            }

            isSending = true;
            submitBtn.disabled = true;

            // Nếu có request trước chưa kết thúc và bạn muốn abort:
            if (lastXhr && lastXhr.readyState !== 4) {
                lastXhr.abort();
                lastXhr = null;
            }

            lastXhr = $.ajax({
                url: "/shopjewelry3/includes/add_comment.php",
                method: "POST",
                dataType: "json",
                data: {
                    product_id: productId,
                    rating: rating,
                    comment: comment
                },
                success: function (res) {
                    isSending = false;
                    submitBtn.disabled = false;

                    if (!res) {
                        alert("Lỗi phản hồi từ server!");
                        return;
                    }
                    if (res.status === "not_logged_in") {
                        alert("Bạn phải đăng nhập để bình luận.");
                        return;
                    }
                    if (res.status === "duplicate") {
                        alert("Bình luận này vừa được gửi — tránh gửi trùng.");
                        return;
                    }
                    if (res.status === "success") {
                        commentBox.value = "";
                        selectedRating = 0;
                        ratingInput.value = 0;
                        stars.forEach(s => s.classList.remove("selected"));
                        // reload comments ngay sau khi insert
                        loadComments();
                    } else {
                        alert(res.message || "Lỗi khi gửi bình luận");
                    }
                },
                error: function (xhr, status, err) {
                    isSending = false;
                    submitBtn.disabled = false;
                    console.error("AJAX error", status, err);
                    alert("Lỗi hệ thống, vui lòng thử lại sau.");
                }
            });
        });

        // Load bình luận
        function loadComments() {
            $.ajax({
                url: "/shopjewelry3/includes/load_comments.php",
                method: "GET",
                dataType: "json",
                data: { product_id: productId },
                success: function (comments) {
                    console.log("Comments loaded:", comments); // debug
                    if (!Array.isArray(comments)) {
                        commentList.innerHTML = "<p>Lỗi tải bình luận!</p>";
                        return;
                    }

                    let html = "";

                    comments.forEach(c => {
                        const rating = Number(c.rating) || 0;
                        const starsStr = "★".repeat(rating) + "☆".repeat(5 - rating);

                        // escape text basic (prevent XSS)
                        const fullname = (c.fullname || "").replace(/</g, "&lt;").replace(/>/g, "&gt;");
                        const created = (c.created_at || "");
                        const commentText = (c.comment || "").replace(/</g, "&lt;").replace(/>/g, "&gt;");

                        html += `
                            <div class="comment-item">
                                <img src="${c.avatar}" alt="avatar" onerror="this.src='/shopjewelry3/assets/imgs/avatars/user.jpg'">
                                <div class="comment-content">
                                    <div class="name">${fullname}</div>
                                    <div class="date">${created}</div>
                                    <div class="stars">${starsStr}</div>
                                    <div class="text">${commentText}</div>
                                </div>
                            </div>
                        `;
                    });

                    commentList.innerHTML = html;
                },
                error: function (xhr, st, err) {
                    console.error("Load comment error", st, err);
                    commentList.innerHTML = "<p>Lỗi tải bình luận!</p>";
                }
            });
        }

        // Load on start
        loadComments();
    });
}
