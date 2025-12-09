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

    <!-- SCRIPT -->
    <script src="../public/assets/libs/jquery-3.7.1.min.js"></script>
    <script src="../public/js/cart.js" defer></script>
    <script src="../public/js/homepage.js" defer></script>

    <!-- ICON -->
    <link rel="stylesheet" href="../public/assets/icons/css/all.min.css">
</head>
<style>
.product .big a{
    text-decoration: none;
    color: #000;
}
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
                    Discover our handcrafted jewelry pieces, meticulously designed to celebrate
                    life's most precious moments with unparalleled beauty and craftsmanship.
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
                <p class="banner-text">Embrace the warmth of the season with our latest collection, featuring rich gold
                    tones and exquisite gemstones that capture the essence of fall.</p>
                <a href="#" class="btn btn-light">Discover Now</a>
            </div>
        </div>

        <!-- Testimonials -->
        <div class="testimonials">
            <h2 class="section-title">Client Testimonials</h2>
            <div class="testimonial-grid">
                <div class="testimonial-card">
                    <p class="testimonial-text">"The craftsmanship of my engagement ring exceeded all expectations. The
                        attention to detail is remarkable, and I receive compliments everywhere I go."</p>
                    <div class="testimonial-author">
                        <img src="../assets/imgs/banner/women2.jpg" alt="Sarah Johnson" class="author-image">
                        <div>
                            <p class="author-name">Sarah Johnson</p>
                            <p class="author-title">Client since 2021</p>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <p class="testimonial-text">"I've purchased multiple pieces from this jeweler over the years. Each
                        piece tells a story and holds sentimental value. Their quality is unmatched."</p>
                    <div class="testimonial-author">
                        <img src="../assets/imgs/banner/men1.jpg" alt="Michael Thompson" class="author-image">
                        <div>
                            <p class="author-name">Michael Thompson</p>
                            <p class="author-title">Client since 2018</p>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <p class="testimonial-text">"The custom design service allowed me to create a truly unique piece for
                        my wife's anniversary gift. The designers captured exactly what I envisioned."</p>
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
                    At Aurelia, we believe every piece of jewelry tells a story — of love, heritage, and artistry.
                    For over two decades, we’ve been handcrafting timeless designs that celebrate the moments that
                    matter most. Our team of skilled artisans combines traditional craftsmanship with modern
                    elegance, using only the finest ethically sourced materials.
                </p>
                <p class="story-paragraph">
                    From the first sketch to the final polish, each creation is a testament to our commitment to
                    excellence. We invite you to explore a world where passion meets precision.
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
                At Aurelia, we believe that true beauty lies in timeless design and intentional craftsmanship. Every
                piece we create is a tribute to life’s most cherished moments — carefully shaped by hand, guided by
                tradition, and finished with elegance.
            </p>
            <p class="about-paragraph">
                With a commitment to ethical sourcing and artisanal precision, our collections reflect more than
                luxury — they reflect legacy. From bespoke engagement rings to everyday fine jewelry, we craft each
                design to become a part of your story.
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
            <p class="newsletter-text">Subscribe to receive updates on new collections, exclusive offers, and styling
                inspiration.</p>
            <form class="newsletter-form">
                <input type="email" placeholder="Your email address" class="newsletter-input" required>
                <button type="submit" class="newsletter-btn">Subscribe</button>
            </form>
        </div>

    <?php include_once('footer.php'); ?>
    <?php include_once("./cart.php"); ?>
</body>

</html>