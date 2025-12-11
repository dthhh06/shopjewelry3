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
    <link rel="stylesheet" href="../public/assets/icons/css/all.min.css">
    <script src="../public/assets/libs/jquery-3.7.1.min.js"></script>
    <script src="../public/js/cart.js"></script>

    <script>
        function changeImage(src) {
            document.getElementById("mainImage").src = src;
        }
    </script>

    <style>
        .thumb-list img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border: 2px solid #ddd;
            cursor: pointer;
            margin-right: 10px;
            border-radius: 5px;
        }

        .thumb-list img:hover {
            border-color: #d4af37;
        }

        .big-image img {
            width: 100%;
            height: 450px;
            object-fit: cover;
            border-radius: 10px;
        }

        .product-info {
            margin-left: 100px;
        }

        .pro-price {
            font-size: 20px;
            font-weight: 400;
            color: #d4af37;
        }
    </style>
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

        <?php include_once('footer.php'); ?>
    </div>

    <?php include("./cart.php"); ?>


</body>

</html>
