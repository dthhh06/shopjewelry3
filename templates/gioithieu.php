<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aurelia Jewelry - About Us</title>
    <link rel="stylesheet" href="../public/assets/css/about.css">

    <!-- ICON -->
    <link rel="stylesheet" href="../public/assets/icons/css/all.min.css">
    <!-- JQUERY -->
    <script src="../public/assets/libs/jquery-3.7.1.min.js"></script>
    <!-- BOOTSTRAP -->

    <!-- JS -->
    <script src="../public/js/cart.js" defer></script>
</head>
    <?php include_once('../templates/header.php'); ?>
<style>
    .story-text-block{
        font-family: 'Cinzel', Arial, Helvetica, sans-serif;
    }
</style>
<body>

    <!-- OUR STORY -->
    <section id="story" class="story-section">
        <div class="story-wrapper">
            <div class="story-text-block">
                <h2>Our Story</h2>
                <p>For over two decades, Aurelia has been creating jewelry that tells a story — a legacy of love, artistry, and craftsmanship. Each piece is thoughtfully designed to celebrate life’s most precious moments.</p>
                <p>Our artisans combine traditional techniques with modern elegance to deliver timeless pieces that are cherished for generations.</p>
            </div>
            <div class="story-image-block">
                <img src="../assets/imgs/story.jpg" alt="Jewelry Craftsmanship">
            </div>
        </div>
    </section>

    <!-- MISSION & VISION -->
    <section class="mv-section">
        <div class="mv-wrapper">
            <div class="mv-card">
                <h3>Mission</h3>
                <p>To craft meaningful, beautiful jewelry that resonates with every moment of your life.</p>
            </div>
            <div class="mv-card">
                <h3>Vision</h3>
                <p>To be recognized globally as a symbol of artisanal excellence and timeless elegance.</p>
            </div>
            <div class="mv-card">
                <h3>Values</h3>
                <p>Integrity, creativity, sustainability, and a passion for quality craftsmanship.</p>
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