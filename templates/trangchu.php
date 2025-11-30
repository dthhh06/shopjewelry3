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
        <div class="hero">
            <div class="hero-content">
                <p class="hero-subtitle">EXQUISITE COLLECTION</p>
                <h1 class="hero-title">Timeless Elegance in Every Detail</h1>
                <p class="hero-description">Discover our handcrafted jewelry pieces, meticulously designed to celebrate
                    life's most precious moments with unparalleled beauty and craftsmanship.</p>
                <a href="#" class="btn">Explore Collection</a>
            </div>
        </div>

    <!-- Start Hot Deal -->
    <section class="section-top-60">
        <div class="shell position-relative">
            <h3>
                <a href="">HOT DEAL</a>
            </h3>

            <hr class="divider divider-base divider-bold">

            <div class="hot-deal-prd row flex-nowrap"></div>

            <!-- Next and Previous buttons -->
            <button type="button" title="next" class="position-absolute btn btn-primary rounded-circle next" style="top:180px; right:-24px; background-color:#b2976d;">
                <i class="fa-solid fa-caret-right text-center m-0" style="font-size: 20px; vertical-align:middle;"></i>
            </button>
            <button type="button" title="previous" class="position-absolute btn btn-primary rounded-circle prev" style="top:180px; left:-24px; background-color:#b2976d;">
                <i class="fa-solid fa-caret-left text-center m-0" style="font-size: 20px; vertical-align:middle"></i>
            </button>
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
                <img src="../assets/imgs/story.jpg" alt="Jewelry craftsmanship at Aurelia" class="story-image">
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




    <?php include_once('footer.php'); ?>
    <?php include_once("./cart.php"); ?>
</body>

</html>