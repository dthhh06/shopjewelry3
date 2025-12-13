<?php include_once('./header.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Feedback</title>

    <link rel="stylesheet" href="../public/assets/icons/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="../public/assets/css/config.css">
    <link rel="stylesheet" href="../public/assets/css/feedback.css">

    <!-- JQUERY -->
    <script src="../public/assets/libs/jquery-3.7.1.min.js"></script>

    <!-- JS -->
    <script src="../public/js/feedback.js" type="module"></script>
    <script src="../public/js/cart.js" defer></script>

    <!-- MAP CSS (để đây cho chắc ăn) -->
</head>
<style>
    /* ===== FEEDBACK FORM ===== */
    @font-face {
        font-family: 'Cinzel';
        src: url('../fonts/Cinzel/static/Cinzel-Regular.ttf') format('truetype');
        font-weight: 400;
        font-style: normal;
    }

    @font-face {
        font-family: 'Dancing_Script';
        src: url('../fonts/Dancing_Script/static/DancingScript-Regular.ttf') format('truetype');
        font-weight: 400;
        font-style: normal;
    }

    .feedback-container {
        margin-top: 150px !important;
        max-width: 720px;
        margin: 80px auto 100px;
        padding: 48px 56px;
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.08);
    }

    .feedback-container h1 {
        font-family: 'Cinzel';
        text-align: center;
        font-size: 28px;
        font-weight: 700;
        letter-spacing: 1px;
        margin-bottom: 40px;
        color: #111;
    }

    /* ===== FORM ===== */
    #feedback-form {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .form-group {
        font-family: "Dancing Script";
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 8px;
        color: #222;
    }

    .form-group label span {
        color: #d9534f;
    }

    /* ===== INPUT / TEXTAREA ===== */
    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 14px 16px;
        font-size: 14px;
        border-radius: 6px;
        border: 1px solid #ddd;
        background: #fafafa;
        transition: all 0.25s ease;
    }

    .form-group textarea {
        min-height: 140px;
        resize: vertical;
    }

    /* Focus */
    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #0d8330;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(13, 131, 48, 0.12);
    }

    /* ===== BUTTON ===== */
    #feedback-form .btn {
        padding: 0.7rem 2rem !important;
        font-size: 0.95rem !important;
        background: transparent !important;
        color: #000000ff !important;
        border: 2px solid #000 !important;
        border-radius: 0 !important;
        font-family: 'Cinzel', serif !important;
        cursor: pointer !important;
        transition: all 0.3s ease !important;
        display: inline-block !important;
        text-decoration: none !important;
        letter-spacing: 1px !important;
    }

    #feedback-form .btn:hover {
        background: #000000ff !important;
        color: #ffffff !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15) !important;
    }


    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .feedback-container {
            margin: 60px 16px 80px;
            padding: 32px 24px;
        }

        .feedback-container h1 {
            font-size: 22px;
        }
    }

    /* ===== GOOGLE MAP EMBED ===== */
    .map-wrapper {
        width: 100%;
        background: #f5f5f5;
        padding: 60px 0;
    }

    .googleMap-info {
        position: relative;
        width: 100%;
        max-width: 1200px;
        height: 480px;
        margin: 0 auto;
        overflow: hidden;
        background: #eaeaea;
    }

    .googleMap-info iframe {
        width: 100% !important;
        height: 100% !important;
        border: 0;
        display: block;
        filter: grayscale(8%);
    }

    .map-info {
        position: absolute;
        top: 45%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: rgba(255, 255, 255, 0.95);
        padding: 10px 24px;
        font-weight: 800;
        letter-spacing: 2px;
        font-size: 14px;
        z-index: 5;
        border-radius: 4px;
        pointer-events: none;
    }

    .map-info strong {
        color: #0d8330;
    }

    @media (max-width: 768px) {
        .googleMap-info {
            height: 320px;
        }

        .map-info {
            font-size: 12px;
            padding: 8px 16px;
        }
    }
</style>

<body>

    <div class="page">
        <!-- FEEDBACK FORM -->
        <div class="feedback-container">
            <h1>Feedback Form</h1>

            <form id="feedback-form" action="../includes/submit_feedback.php" method="post" novalidate>
                <div class="form-group">
                    <label>Your name <span class="text-danger">*</span></label>
                    <input
                        type="text"
                        name="name"
                        placeholder="Enter your name"
                        required
                        maxlength="100" />
                </div>

                <div class="form-group">
                    <label>Your email <span class="text-danger">*</span></label>
                    <input
                        type="email"
                        name="email"
                        placeholder="Enter your email"
                        required
                        maxlength="150" />
                </div>

                <div class="form-group">
                    <label>Your phone number <span class="text-danger">*</span></label>
                    <input
                        type="text"
                        name="phonenumber"
                        placeholder="Enter your phone number"
                        required
                        pattern="[0-9]{9,11}"
                        title="Phone number must be 9–11 digits" />
                </div>

                <div class="form-group">
                    <label>Your feedback <span class="text-danger">*</span></label>
                    <textarea
                        name="message"
                        placeholder="Enter your feedback"
                        required
                        maxlength="500"></textarea>
                </div>

                <!-- Bắt buộc có name="submit_feedback" -->
                <button type="submit" name="submit_feedback" class="btn">
                    Submit Feedback
                </button>
            </form>
        </div>



        <div class="map-wrapper" id="mapWrapper">
            <div class="googleMap-info">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3835.7340250120246!2d108.25065207580506!3d15.97526028469072!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142108997dc971f%3A0x1295cb3d313469c9!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2jhu4cgVGjDtG5nIHRpbiB2w6AgVHJ1eeG7gW4gdGjDtG5nIFZp4buHdCAtIEjDoG4sIMSQ4bqhaSBo4buNYyDEkMOgIE7hurVuZw!5e0!3m2!1svi!2s!4v1747362615642!5m2!1svi!2s"
                    style="border: 0"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>

                <div class="map-info">
                    <strong>AURELIA</strong>
                </div>
            </div>
        </div>

        <?php include_once("../templates/footer.php"); ?>
    </div>

    <!-- Cart -->
    <?php include_once("./cart.php"); ?>

    <!-- MAP JS (CHẠY ĐÚNG, KHÔNG THỪA) -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const iframe = document.querySelector(".google-map-iframe");
            const wrapper = document.getElementById("mapWrapper");

            if (!iframe || !wrapper) return;

            const observer = new IntersectionObserver((entries, obs) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        iframe.src = iframe.dataset.src;
                        obs.disconnect();
                    }
                });
            }, {
                threshold: 0.2
            });

            observer.observe(wrapper);
        });
    </script>
</body>

</html>