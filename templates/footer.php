<style>
    .lux-footer {
        background: linear-gradient(135deg, #0e0e0e, #1a1a1a, #0f0f0f);
        color: #e5e5e5;
        padding: 4.5rem 8%;
        font-family: "Dancing script", serif;
        border-top: 1px solid #2f2f2f;
        position: relative;
        overflow: hidden;
    }

    .lux-footer::before {
        content: "";
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.06), transparent 70%);
        animation: footerGlow 12s infinite linear;
    }

    @keyframes footerGlow {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    /* Grid chính */
    .lux-footer-container {
        position: relative;
        z-index: 10;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 3rem;
    }

    /* Logo */
    .lux-footer-logo {
        font-family: 'Cinzel', serif;
        font-size: 2.5rem;
        font-weight: 700;
        color: #d5b892;
        transition: transform 0.4s ease;
    }

    .lux-footer-logo:hover {
        transform: translateY(-3px);
    }

    .lux-footer-desc {
        margin-top: 1rem;
        line-height: 1.7;
        max-width: 250px;
        color: #cfcfcf;
    }

    /* Titles */
    .lux-footer-title {
        font-family: 'Cinzel', serif;
        font-size: 1.2rem;
        margin-bottom: 1.2rem;
        letter-spacing: 1px;
        color: #e3e3e3;
        position: relative;
    }

    .lux-footer-title::after {
        content: "";
        width: 35px;
        height: 2px;
        background: #b2976d;
        display: block;
        margin-top: 5px;
    }

    /* Links */
    .lux-footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .lux-footer-links li {
        margin-bottom: 0.6rem;
    }

    .lux-footer-links a {
        text-decoration: none;
        color: #bfbfbf;
        font-size: 0.97rem;
        transition: color 0.3s ease, padding-left 0.3s ease;
    }

    .lux-footer-links a:hover {
        color: #ffffff;
        padding-left: 5px;
    }

    /* Contact */
    .lux-footer-section p {
        margin: 0.4rem 0;
        color: #c7c7c7;
    }

    /* Social icons */
    .social-icons {
        margin-top: 1.2rem;
        display: flex;
        gap: 12px;
    }

    .social-icons i {
        font-size: 1.2rem;
        padding: 10px;
        border-radius: 50%;
        background: #222;
        cursor: pointer;
        transition: 0.3s ease;
    }

    .social-icons i:hover {
        background: #b2976d;
        color: #000;
        transform: translateY(-4px);
    }

    /* Payment icons */
    .payment-icons {
        display: flex;
        gap: 15px;
        margin-top: 1rem;
    }

    .payment-icons img {
        width: 55px;
        height: 40px;
        filter: grayscale(80%);
        transition: 0.3s ease;
        border-radius: 12px;
    }

    .payment-icons img:hover {
        filter: grayscale(0%);
        transform: scale(1.08);
    }

    /* Bottom bar */
    .lux-footer-bottom {
        text-align: center;
        padding-top: 2.5rem;
        margin-top: 3rem;
        border-top: 1px solid #333;
        font-size: 0.9rem;
        color: #999;
    }

    @media (max-width: 600px) {
        .lux-footer {
            text-align: center;
        }

        .social-icons,
        .payment-icons {
            justify-content: center;
        }
    }
</style>

<footer class="lux-footer">

    <div class="lux-footer-container">

        <!-- Logo -->
        <div class="lux-footer-section">
            <a href="./trangchu.php" class="logo">
                <i class="fas fa-gem"></i>
                AURELIA
            </a>
            <p class="lux-footer-desc">
                Timeless luxury. Exquisite craftsmanship.
            </p>

            <!-- Social icons -->
            <div class="social-icons">
                <i class="fab fa-facebook-f"></i>
                <i class="fab fa-instagram"></i>
                <i class="fab fa-tiktok"></i>
                <i class="fab fa-youtube"></i>
            </div>
        </div>

        <!-- Navigation -->
        <div class="lux-footer-section">
            <h3 class="lux-footer-title">Explore</h3>
            <ul class="lux-footer-links">
                <li><a href="#">Home</a></li>
                <li><a href="#">Jewelry</a></li>
                <li><a href="#">Necklaces</a></li>
                <li><a href="#">Collections</a></li>
            </ul>
        </div>

        <!-- Services -->
        <div class="lux-footer-section">
            <h3 class="lux-footer-title">Services</h3>
            <ul class="lux-footer-links">
                <li><a href="#">Book an Appointment</a></li>
                <li><a href="#">Customer Care</a></li>
                <li><a href="#">Policies</a></li>
                <li><a href="#">Repair & Cleaning</a></li>
            </ul>

            <!-- Payment methods -->
            <div class="payment-icons">
                <img src="../assets/imgs/brand/mastercard.jpg">
                <img src="../assets/imgs/brand/GPay.jpg">
                <img src="../assets/imgs/brand/momo.jpg">
                <img src="../assets/imgs/brand/zalopay.jpg">
            </div>
        </div>

        <!-- Info -->
        <div class="lux-footer-section">
            <h3 class="lux-footer-title">Contact</h3>
            <p>+84 123 456 789</p>
            <p>support@aurelia.com</p>
            <p>Da Nang City, Vietnam</p>
        </div>

    </div>

    <div class="lux-footer-bottom">
        © 2025 AURELIA Jewelry. All Rights Reserved.
    </div>
</footer>