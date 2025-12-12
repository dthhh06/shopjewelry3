<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aurelia Jewelry - About Us</title>


    <link rel="stylesheet" href="../public/assets/css/about.css">
    <link rel="stylesheet" href="../public/assets/css/config.css"> 
    <link rel="stylesheet" href="../public/assets/css/sanpham.css">

    <!-- ICON -->
    <link rel="stylesheet" href="../public/assets/icons/css/all.min.css">

    <!-- JQUERY -->
    <script src="../public/assets/libs/jquery-3.7.1.min.js"></script>
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <!-- JS -->
    <script src="../public/js/cart.js" defer></script>
</head>
<style>
    .story-text-block {
        font-family: 'Cinzel', Arial, Helvetica, sans-serif;
    }
</style>

<body>
    <?php include_once('./header.php') ?>

    <section>
        <div class="wrapper_" style="height: 90px; color:#fff">
        </div>
    </section>

    <!-- OUR STORY -->
    <section id="story" class="story-section">
        <div class="story-wrapper">
            <div class="story-text-block">
                <h2>Our Story</h2>
                <p>Trong hơn hai thập kỷ, Aurelia đã sáng tạo nên những món trang sức kể câu chuyện - di sản của tình yêu, nghệ thuật và tay nghề thủ công. Mỗi sản phẩm đều được thiết kế tỉ mỉ để tôn vinh những khoảnh khắc quý giá nhất của cuộc sống.</p>
            </div>
            <div class="story-image-block">
                <img src="../assets/imgs/banner/story.png" alt="Jewelry Craftsmanship">
            </div>
        </div>
    </section>

    <!-- MISSION & VISION -->
    <section class="mv-section">
        <div class="mv-wrapper">
            <div class="mv-card">
                <h3>Mission</h3>
                <p>
                    Để chế tác những món đồ trang sức đẹp và ý nghĩa, đồng điệu với từng khoảnh khắc trong cuộc sống của bạn.</p>
            </div>
            <div class="mv-card">
                <h3>Vision</h3>
                <p>
                    Được công nhận trên toàn cầu như một biểu tượng của sự xuất sắc trong nghệ thuật thủ công và sự thanh lịch vượt thời gian.</p>
            </div>
            <div class="mv-card">
                <h3>Values</h3>
                <p>Chính trực, sáng tạo, bền vững và đam mê với nghề thủ công chất lượng.</p>
            </div>
        </div>
    </section>

    <!-- TEAM -->
    <section class="team-section">
        <h2>Meet Our Artisans</h2>
        <div class="team-wrapper">
            <div class="team-card">
                <img src="../assets/imgs/banner/thao.jpg" alt="">
                <h4>Lê Tô Diệu Thảo</h4>
                <p>Trưởng nhóm</p>
            </div>
            <div class="team-card">
                <img src="../assets/imgs/banner/linh.jpg" alt="">
                <h4>Nguyễn Thị Mỹ Linh</h4>
                <p>Thành viên</p>
            </div>
        </div>
    </section>
    <?php include_once('./footer.php'); ?>

</body>

</html>