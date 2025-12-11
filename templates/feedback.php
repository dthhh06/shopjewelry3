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
    <link rel="stylesheet" href="../public/assets/css/sanpham.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <!-- JQUERY -->
    <script src="../public/assets/libs/jquery-3.7.1.min.js"></script> 
    <!-- JavaScript -->
    <script src="../public/js/feedback.js" type="module"></script> 
    <script src="../public/js/cart.js" defer></script>
</head>

<body>
    <div class="page">
        <?php include_once('./header.php'); ?>

    <div class="feedback-container">
        <h1>Feedback Form</h1>
        <form id="feedback-form" action="../includes/submit_feedback.php" method="post">
            <div class="form-group">
                <label for="name">Your name <span class="text-danger">*</span></label>
                <input type="text" id="name" name="name" placeholder="Enter your name" />
                <div class="error-message"></div>
            </div>
            <div class="form-group">
                <label for="email">Your email <span class="text-danger">*</span></label>
                <input type="email" id="email" name="email" placeholder="Enter your email" />
                <div class="error-message"></div>
            </div>
            <div class="form-group">
                <label for="phonenumber">Your phone number <span class="text-danger">*</span></label>
                <input type="text" id="phonenumber" name="phonenumber" placeholder="Enter your phonenumber" />
                <div class="error-message"></div>
            </div>
            <div class="form-group">
                <label for="message">Your feedback <span class="text-danger">*</span></label>
                <textarea id="message" name="message" placeholder="Enter your feedback"></textarea>
                <div class="error-message"></div>
            </div>
            <button type="button" name="submit_feedback" value="submit_feedback">Submit Feedback</button>
        </form>
    </div>

    <?php
    include_once("../templates/footer.php");
    ?>
</div>
    <!-- Cart -->
    <?php include_once("./cart.php"); ?>
</body>

</html>