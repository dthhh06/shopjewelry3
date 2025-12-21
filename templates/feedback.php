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
    <!-- <script src="../public/assets/libs/jquery-3.7.1.min.js"></script> -->

    <!-- JS -->
    <script src="../public/js/feedback.js" type="module"></script>

</head>
    <!-- <script src="../public/js/cart.js" defer></script> -->

<style>

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