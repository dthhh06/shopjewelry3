<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "web_trang_suc";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$id = isset($_GET['data-productid']) ? $_GET['data-productid'] : "";

$sql = "SELECT * FROM `product` WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$productDetails = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Sản Phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <link rel="stylesheet" href="../public/assets/css/config.css">
    <link rel="stylesheet" href="../public/assets/css/sanpham.css">
    <link rel="stylesheet" href="../public/assets/css/productdetail.css">

    <link rel="stylesheet" href="../public/assets/icons/css/all.min.css">
    <script src="../public/assets/libs/jquery-3.7.1.min.js"></script>
    <script src="../public/js/cart.js"></script>
    <script src="../public/js/productdetail_comment.js"></script>

    <script>
        function changeImage(src) {
            document.getElementById("mainImage").src = src;
        }
    </script>
</head>

<body>
    <div class="page">

        <?php include_once('header.php'); ?>

        <div class="container" style="margin-top: 160px;">

            <div class="row">
                <div class="main-bread-crumb">
                    <?php
                    $breadcrumb_parts = [
                        ['name' => 'Trang chủ', 'url' => 'trangchu.php'],
                        ['name' => 'Sản phẩm', 'url' => 'SanPham.php'],
                        ['name' => $productDetails['title'], 'url' => 'productdetails.php?'],
                    ];

                    $breadcrumb_html = array_map(function ($part) {
                        $is_current = (parse_url(str_replace('/shopjewelry3/templates/', '', $_SERVER['REQUEST_URI']), PHP_URL_PATH) == $part['url']);
                        return '<a href="' . $part['url'] . '"' . ($is_current ? ' class="current"' : '') . '>' . $part['name'] . '</a>';
                    }, $breadcrumb_parts);

                    echo '<div class="breadcrumb">' . implode(' > ', $breadcrumb_html) . '</div>';
                    ?>
                </div>
            </div>

            <!-- ==================== PRODUCT DETAILS ======================== -->
            <div class="row productdetail-item" data-productquantity="<?= $productDetails["quantity"]; ?>" data-productid="<?= $productDetails["id"]; ?>">

                <!-- LEFT IMAGES -->
                <div class="col-md-6 col-lg-16 col-12">

                    <div class="big-image">
                        <img id="mainImage" src="<?= $productDetails['thumbnail']; ?>" alt="">
                    </div>

                    <div class="thumb-list mt-3 d-flex">

                        <!-- Thumbnail -->
                        <img onclick="changeImage('<?= $productDetails['thumbnail']; ?>')"
                            src="<?= $productDetails['thumbnail']; ?>">

                        <!-- Image 1 -->
                        <?php if (!empty($productDetails['image1'])) { ?>
                            <img onclick="changeImage('<?= $productDetails['image1']; ?>')"
                                src="<?= $productDetails['image1']; ?>">
                        <?php } ?>

                        <!-- Image 2 -->
                        <?php if (!empty($productDetails['image2'])) { ?>
                            <img onclick="changeImage('<?= $productDetails['image2']; ?>')"
                                src="<?= $productDetails['image2']; ?>">
                        <?php } ?>

                    </div>
                </div>

                <!-- RIGHT INFO -->
                <div class="col-md-6 col-lg-16 col-12">
                    <div class="product-info mt-lg-0 mt-md-0 m-0 mt-3">

                        <div class="border-item-bottom">
                            <h2 class="pro-name"><?= $productDetails['title']; ?></h2>
                            <div class="pro-price margin-bottom-20"><?= number_format($productDetails['price']); ?>đ</div>
                        </div>

                        <div class="pro-description border-item-bottom margin-bottom-20">
                            <p><?= $productDetails['description']; ?></p>
                        </div>

                        <div class="pro-quantity d-block d-md-flex d-lg-flex border-item-bottom ">
                            <div class="pro-action ms-0 margin-bottom-20">
                                <?php if (intval($productDetails['quantity']) <= 0) { ?>
                                    <button class="btn" style="pointer-events:none; background-color:#d4af37; border-color:#d4af37;">
                                        Hết hàng
                                    </button>
                                <?php } else { ?>
                                    <button class="btn btn-primary" name="add_product_to_cart">
                                        <i class="fa fa-shopping-cart"></i> Mua hàng
                                    </button>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="top-left d-lg-flex d-md-flex d-none">
                            <label class="share">Chia sẻ: </label>
                            <i class="fa-brands fa-facebook-f"></i>
                            <i class="fa-brands fa-pinterest"></i>
                            <i class="fa-brands fa-google"></i>
                            <i class="fa-brands fa-square-instagram"></i>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- MÔ TẢ -->
        <div class="res-tab text-center w-100">
            <h2 class="mota border-item-bottom">Mô tả sản phẩm</h2>
            <p><?= $productDetails['description']; ?></p>

            <img class="img-responsive w-100" src="../<?= $productDetails['thumbnail']; ?>" alt="">
        </div>

        <!-- ================= COMMENT SECTION ================= -->
        <div id="commentsSection" data-product-id="<?= $product_id ?>">

            <div class="comment-wrapper">

                <h4 class="cmt-title">Đánh giá & Bình luận</h4>

                <!-- Rating -->
                <div class="rating-stars">
                    <i class="fa-solid fa-star" data-index="0"></i>
                    <i class="fa-solid fa-star" data-index="1"></i>
                    <i class="fa-solid fa-star" data-index="2"></i>
                    <i class="fa-solid fa-star" data-index="3"></i>
                    <i class="fa-solid fa-star" data-index="4"></i>
                </div>

                <input type="hidden" id="ratingInput" value="0">

                <!-- Comment box -->
                <div class="comment-box">
                    <textarea id="commentText" placeholder="Nhập bình luận của bạn..."></textarea>
                    <button id="submitComment">Gửi bình luận</button>
                </div>

                <h5 class="cmt-subtitle">Các bình luận:</h5>
                <div id="commentList"></div>

            </div>

        </div>

        <style>
            
            /* Khung tổng chứa mọi thứ */
            .comment-wrapper {
                width: 100%;
                max-width: 1200px;
                padding: 20px;
                margin: 0 auto;
                background: #ffffff;
                border-radius: 12px;
                border: 1px solid #e8e8e8;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
                margin-bottom: 30px;
            }

            .cmt-title {
                font-weight: 600;
                margin-bottom: 15px;
            }

            .cmt-subtitle {
                margin-top: 25px;
                font-weight: 600;
            }

            /* Comment box */
            .comment-box {
                margin-top: 15px;
                padding: 15px;
                border-radius: 10px;
                background: #fafafa;
                border: 1px solid #e5e5e5;
            }

            .comment-box textarea {
                width: 100%;
                min-height: 110px;
                border-radius: 8px;
                padding: 12px;
                border: 1px solid #ccc;
                resize: vertical;
                margin-bottom: 10px;
            }

            .comment-box button {
                padding: 10px 18px;
                border-radius: 8px;
                background: #ff9900;
                border: none;
                color: white;
                cursor: pointer;
                font-weight: 600;
            }

            .comment-box button:hover {
                background: #ff7b00;
            }

            /* Rating Stars */
            .rating-stars {
                display: flex;
                gap: 6px;
                cursor: pointer;
                margin-bottom: 10px;
            }

            .rating-stars i {
                font-size: 32px;
                color: #d5d5d5;
                transition: 0.15s;
            }

            .rating-stars i.hovered,
            .rating-stars i.selected {
                color: #ffc400;
                transform: scale(1.1);
            }

            /* Comment item */
            .comment-item {
                display: flex;
                gap: 12px;
                padding: 12px 0;
                border-bottom: 1px solid #eee;
            }

            .comment-item img {
                width: 45px;
                height: 45px;
                border-radius: 50%;
                object-fit: cover;
            }

            .comment-content .name {
                font-weight: 600;
                margin-bottom: 2px;
            }

            .comment-content .date {
                color: #888;
                font-size: 13px;
                margin-bottom: 3px;
            }
        </style>
        <?php include_once('footer.php'); ?>
    </div>
    <script src="../public/js/productdetail_comment.js"></script>
    <?php include("./cart.php"); ?>


</body>

</html>