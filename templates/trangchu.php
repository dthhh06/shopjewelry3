<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Trang Chủ</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../public/assets/css/config.css">
    <link rel="stylesheet" href="../public/assets/css/sanpham.css">
    <link rel="stylesheet" href="../public/assets/css/homepage.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />


    <!-- SCRIPT -->
    <script src="../public/assets/libs/jquery-3.7.1.min.js"></script>
    <script src="../public/js/cart.js" defer></script>
    <script src="../public/js/homepage.js" defer></script>

    <!-- ICON -->
    <link rel="stylesheet" href="../public/assets/icons/css/all.min.css">
</head>
<style>
    /* Hero Section */
    .hero-wrapper {
        position: relative;
        height: 100vh;
        overflow: hidden;

        display: flex;
        justify-content: center;
        align-items: flex-end;
        padding-bottom: 5%;
    }

    /* Video nền */
    .hero-video {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transform: translate(-50%, -50%);
        z-index: -2;
    }

    .contentt {
        font-family: "Dancing Script", Arial, Helvetica, sans-serif;
        width: 100%;
        display: block;
        text-align: center;
        padding: 50px 20px;
    }

    .hero-content {
        max-width: 600px;
        margin: 0 auto;
        animation: fadeIn 1.5s ease-out;
    }

    .hero-subtitle {
        font-family: 'Cinzel', serif;
        color: #b2976d;
        font-size: 1rem;
        letter-spacing: 2px;
        margin-bottom: 0.5rem;
    }

    .hero-title {
        font-family: 'Cinzel', serif;
        font-size: 2rem;
        color: #2a2a2a;
        line-height: 1.2;
        margin-bottom: 1rem;
    }

    .hero-description {
        font-family: "Dancing Script", serif;
        font-size: 0.95rem;
        margin-bottom: 1.5rem;
        color: #555;
    }

    .btn {
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
    }

    .btn:hover {
        background: #000000ff !important;
        color: white !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15) !important;
    }

    .img-responsive {
        border: 2px solid #f0e8daff !important;
        padding: 2px;
    }

    /* Collection Banner */
    .collection-banner {
        height: 60vh !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        background: linear-gradient(rgba(0, 0, 0, 0.363), rgba(0, 0, 0, 0.158)),
            url('../assets/imgs/banner/bg1.jpg') !important;
        background-size: cover !important;
        background-position: center !important;
        background-attachment: fixed !important;
        color: white !important;
        text-align: center !important;
        padding: 0 5% !important;
    }

    .banner-content {
        max-width: 800px !important;
    }

    .banner-title {
        font-family: 'Cinzel', serif !important;
        font-size: 3rem !important;
        margin-bottom: 1.5rem !important;
    }

    .banner-text {
        font-family: "Dancing Script", Arial, Helvetica, sans-serif !important;
        font-size: 1.2rem !important;
        margin-bottom: 2rem !important;
        opacity: 0.9 !important;
    }
</style>

<body>
    <?php
    if (isset($_SESSION['order_placed'])) {
        if ($_SESSION['order_placed']) {
            echo '<script>alert("Order placed successfully")</script>';
        } else {
            echo '<script>alert("Order placed failed")</script>';
        }
        unset($_SESSION['order_placed']);
    }
    ?>
    <?php include_once 'header.php'; ?>

    <!-- Home Section -->
    <section class="home-section">
        <!-- Hero Section -->
        <div class="hero-wrapper">

            <video class="hero-video" autoplay muted loop>
                <source src="../assets/imgs/banner/bg.mp4" type="video/mp4">
            </video>
        </div>
        <div class="contentt">
            <div class="hero-content">
                <p class="hero-subtitle">EXQUISITE COLLECTION</p>
                <h1 class="hero-title">Timeless Elegance in Every Detail</h1>
                <p class="hero-description">
                    Khám phá những món trang sức thủ công của chúng tôi, được thiết kế tỉ mỉ để tôn vinh những khoảnh khắc quý giá nhất của cuộc sống với vẻ đẹp và sự tinh xảo không gì sánh bằng.
                </p>
                <a href="#" class="btn">Explore Collection</a>
            </div>
        </div>

        <!-- Start Hot Deal -->
        <section class="section-top-60">
            <div class="container">
                <h2 class="text-center">HOT DEALS</h2>
                <div class="hot-deal-prd row flex-nowrap"></div>

                <div class="row hot-deal-prd"></div>
                <div class="d-flex justify-content-center mt-3"> <button class="prev btn btn-outline-dark me-3">Prev</button> <button class="next btn btn-outline-dark">Next</button> </div>
            </div>
        </section>
        <!-- End Hot Deal -->

        <!-- Collection Banner -->
        <div class="collection-banner">
            <div class="banner-content">
                <h2 class="banner-title">The Autumn Collection</h2>
                <p class="banner-text">Tận hưởng sự ấm áp của mùa này với bộ sưu tập mới nhất của chúng tôi, với tông màu vàng rực rỡ và đá quý tinh tế, lưu giữ bản chất của mùa thu.</p>
                <a href="#" class="btn btn-light">Discover Now</a>
            </div>
        </div>

        <!-- Testimonials -->
        <div class="testimonials">
            <h2 class="section-title">Client Testimonials</h2>
            <div class="testimonial-grid">
                <div class="testimonial-card">
                    <p class="testimonial-text">"
                        Tay nghề chế tác chiếc nhẫn đính hôn của tôi vượt xa mọi mong đợi.
                        Sự tỉ mỉ đến từng chi tiết thật đáng kinh ngạc, và tôi nhận được lời khen ngợi ở mọi nơi tôi đến."</p>
                    <div class="testimonial-author">
                        <img src="../assets/imgs/banner/women2.jpg" alt="Sarah Johnson" class="author-image">
                        <div>
                            <p class="author-name">Sarah Johnson</p>
                            <p class="author-title">Client since 2021</p>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <p class="testimonial-text">"Tôi đã mua nhiều món đồ từ tiệm kim hoàn này trong nhiều năm qua.
                        Mỗi món đồ đều kể một câu chuyện và mang giá trị tình cảm. Chất lượng của chúng là vô song."</p>
                    <div class="testimonial-author">
                        <img src="../assets/imgs/banner/men1.jpg" alt="Michael Thompson" class="author-image">
                        <div>
                            <p class="author-name">Michael Thompson</p>
                            <p class="author-title">Client since 2018</p>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <p class="testimonial-text">"Dịch vụ thiết kế riêng đã cho phép tôi tạo ra một món quà kỷ niệm thực sự độc đáo cho vợ tôi. Các nhà thiết kế đã nắm bắt chính xác những gì tôi hình dung."</p>
                    <div class="testimonial-author">
                        <img src="../assets/imgs/banner/women1.jpg" alt="Jimes Wilsony" class="author-image">
                        <div>
                            <p class="author-name">James Wilson</p>
                            <p class="author-title">Client since 2020</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </section>


    <!-- Start About/ our story -->
    <div class="our-story-section">
        <div class="story-content">
            <div class="story-text">
                <h2 class="section-title">Our Story</h2>
                <p class="story-paragraph">
                    Tại Aurelia, chúng tôi tin rằng mỗi món trang sức đều kể một câu chuyện — về tình yêu, di sản và nghệ thuật.
Trong hơn hai thập kỷ, chúng tôi đã chế tác thủ công những thiết kế vượt thời gian, tôn vinh những khoảnh khắc
quan trọng nhất. Đội ngũ nghệ nhân lành nghề của chúng tôi kết hợp kỹ thuật thủ công truyền thống với
sự thanh lịch hiện đại, chỉ sử dụng những vật liệu tốt nhất có nguồn gốc đạo đức.
                </p>
                <p class="story-paragraph">
                    Từ bản phác thảo đầu tiên đến bản hoàn thiện cuối cùng, mỗi tác phẩm là minh chứng cho cam kết của chúng tôi về sự xuất sắc. Chúng tôi mời bạn khám phá một thế giới nơi đam mê hòa quyện cùng sự chính xác.
                </p>
                <a href="#" class="btn">Learn More</a>
            </div>
            <div class="story-image-container">
                <img src="../assets/imgs/banner/story.jpg" alt="Jewelry craftsmanship at Aurelia" class="story-image">
            </div>
        </div>
    </div>
    <!-- About Section -->
    <section class="about-section-text-only">
        <div class="about-container">
            <h2 class="about-title">Our Story</h2>
            <p class="about-paragraph">
                Tại Aurelia, chúng tôi tin rằng vẻ đẹp đích thực nằm ở thiết kế vượt thời gian và sự khéo léo tinh tế. Mỗi sản phẩm chúng tôi tạo ra đều là sự tôn vinh những khoảnh khắc đáng trân trọng nhất của cuộc sống — được tạo hình tỉ mỉ bằng tay, được dẫn dắt bởi truyền thống và được hoàn thiện một cách tinh tế.
            </p>
            <p class="about-paragraph">
                Với cam kết về nguồn cung ứng có đạo đức và độ chính xác thủ công, các bộ sưu tập của chúng tôi không chỉ phản ánh sự sang trọng — mà còn phản ánh di sản. Từ nhẫn đính hôn được thiết kế riêng đến trang sức tinh xảo hàng ngày, chúng tôi chế tác từng
            </p>
            <a href="#" class="btn">Explore the Collection</a>
        </div>
    </section>

    <!-- End About-->
    <!-- Start product -->
    <section class="section-top-60">
        <div class="shell">
            <div class="range">
                <!-- New -->
                <div class="cell-product new-products">
                    <h5><a href="#">Mới nhất</a></h5>
                    <hr class="divider divider-base divider-bold divider-left">
                    <div class="range-product">

                    </div>
                </div>
                <div class="cell-product outstanding-products">
                    <h5><a href="#">Nổi bật</a></h5>
                    <hr class="divider divider-base divider-bold divider-left">
                    <div class="range-product">

                    </div>
                </div>
                <div class="cell-product bestsellers">
                    <h5><a href="#">Bán chạy</a></h5>
                    <hr class="divider divider-base divider-bold divider-left">
                    <div class="range-product">

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End product -->
    <!-- Newsletter -->
    <div class="newsletter">
        <h2 class="newsletter-title">Join Our Newsletter</h2>
        <p class="newsletter-text">Đăng ký để nhận thông tin cập nhật về bộ sưu tập mới, ưu đãi độc quyền và nguồn cảm hứng về phong cách.</p>
        <form class="newsletter-form">
            <input type="email" placeholder="Your email address" class="newsletter-input" required>
            <button type="submit" class="newsletter-btn">Subscribe</button>
        </form>
    </div>

    <?php include_once('footer.php'); ?>
    <?php include_once("./cart.php"); ?>
</body>

</html>