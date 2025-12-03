<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "web_trang_suc";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$results_per_page = 9;

$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Start with a base SQL query
$sql = "SELECT * FROM product WHERE 1=1";
$params = [];
$types = ''; 


// Filter based on price range
if (isset($_GET["filter-product"], $_GET["input-min"], $_GET["input-max"])) {
    $fromPrice = $_GET["input-min"];
    $toPrice = $_GET["input-max"];
    $sql .= " AND price BETWEEN ? AND ?";
    $types .= 'dd'; 
    array_push($params, $fromPrice, $toPrice);
}

// Filter based on search query
if (isset($_GET['search'])) {
    $search = '%' . $_GET['search'] . '%';
    $sql .= " AND title LIKE ?";
    $types .= 's'; 
    $params[] = $search;
}

// Filter based on category
if (isset($_GET["category_id"])) {
    $category_id = $_GET["category_id"];
    $sql .= " AND category_id = ?";
    $types .= 'i';
    $params[] = $category_id;
}

// Sorting
if (isset($_GET["sort"])) {
    switch ($_GET["sort"]) {
        case 'price-asc':
            $sql .= ' ORDER BY price ASC';
            break;
        case 'price-desc':
            $sql .= ' ORDER BY price DESC';
            break;
        case 'name-asc':
            $sql .= ' ORDER BY title ASC';
            break;
        case 'name-desc':
            $sql .= ' ORDER BY title DESC';
            break;
    }
}

$stmt = $conn->prepare($sql);
if ($types) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
$number_of_results = $result->num_rows;

$number_of_pages = ceil($number_of_results / $results_per_page);

$this_page_first_result = ($current_page - 1) * $results_per_page;

$sql .= " LIMIT ?, ?";
$types .= 'ii';
array_push($params, $this_page_first_result, $results_per_page);

$stmt = $conn->prepare($sql);
if ($types) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$query = $stmt->get_result();

$filters = isset($filters) ? $filters : [];
unset($filters['page']);

$paramsFromUrl = $_GET;

foreach ($paramsFromUrl as $key => $value) {
    if (!array_key_exists($key, $filters)) {
        $filters[$key] = $value;
    }
}

print_r($filters);
$filter_query = http_build_query($filters); 

for ($page = 1; $page <= $number_of_pages; $page++) {
    
    $link = "SanPham.php?" . $filter_query . (!empty($filter_query) ? "&" : "") . "page=" . $page;
    echo '<a href="' . $link . '">' . $page . '</a> ';
}

$sql = "SELECT * FROM `category`";
$result = $conn->query($sql);

$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản Phẩm</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../public/assets/css/config.css">
    <link rel="stylesheet" href="../public/assets/css/sanpham.css">

    <!-- ICON -->
    <link rel="stylesheet" href="../public/assets/icons/css/all.min.css">
    <!-- JQUERY -->
    <script src="../public/assets/libs/jquery-3.7.1.min.js"></script>
    <!-- BOOTSTRAP -->
     
    <!-- JS -->
    <script src="../public/js/cart.js" defer></script>
</head>

<body>
    <div class="page">
        <!--Start Header-->
        <?php include_once('./header.php'); ?>
        <!-- End Header -->

        <div class="container py-0" style="margin-top:160px">
            <div class="row">
                <!--Start bread-crumb -->
                <div class="main-bread-crumb">
                    <?php
                    $breadcrumb_parts = [
                        ['name' => 'Trang chủ', 'url' => 'trangchu.php'],
                        ['name' => 'Sản phẩm', 'url' => 'SanPham.php'],
                    ];


                    $breadcrumb_html = array_map(function ($part) {

                        $is_current_page = (parse_url(str_replace('/shopjewelty3/templates/', '', $_SERVER['REQUEST_URI']), PHP_URL_PATH) == $part['url']);


                        $class = $is_current_page ? ' class="current"' : '';

                        return '<a href="' . $part['url'] . '"' . $class . '>' . $part['name'] . '</a>';
                    }, $breadcrumb_parts);

                    $breadcrumb_html = implode(' > ', $breadcrumb_html);

                    echo '<div class="breadcrumb">' . $breadcrumb_html . '</div>';
                    ?>
                </div>
                <!-- End bread-crumb -->
            </div>

            <!-- Filter product -->
            <div class="row">
                <div id="sort-by">
                    <form action="SanPham.php" method="get">
                        <div class="sort-product mb-3 mx-0">
                            <label for="sort" class="form-label"></label>
                            <select class="form-select" id="sort" name="sort" onchange="this.form.submit()">
                                <option value="default" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'default') echo 'selected'; ?>>
                                    Mặc định</option>
                                <option value="price-asc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'price-asc') echo 'selected'; ?>>
                                    Giá: Thấp đến Cao</option>
                                <option value="price-desc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'price-desc') echo 'selected'; ?>>
                                    Giá: Cao đến Thấp</option>
                                <option value="name-asc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'name-asc') echo 'selected'; ?>>
                                    Tên: A-Z</option>
                                <option value="name-desc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'name-desc') echo 'selected'; ?>>
                                    Tên: Z-A</option>
                            </select>
                        </div>
                    </form>

                    <div class="search-pro w-sm-100">
                        <form action="SanPham.php" method="get">
                            <div class="input-group mb-3 width-50">
                                <input type="text" class="form-control" placeholder="Tìm kiếm sản phẩm" name="search" onchange="this.form.submit()">
                            </div>
                        </form>
                    </div>

                    <div class="title-prod mb-3 mx-0">
                        <span>
                            Hiển thị
                            <?php echo $this_page_first_result + 1 . ' - ' . min($results_per_page + $this_page_first_result, $number_of_results); ?>
                            trong tổng số <?php echo $number_of_results ?> sản phẩm
                        </span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="product-view col-md-9 col-lg-9 col-12">
                    <div class="row">
                        <?php
                        while ($row = mysqli_fetch_array($query)) {
                        ?>

                            <div class="product-item mb-3 col-md-6 col-lg-4 col-12 col-sm-6" data-productquantity="<?php echo intval($row["quantity"]); ?>" data-productid="<?php echo $row["id"] ?>">
                                <div class="product">
                                    <div class="product-img w-100" style="<?php echo intval($row['quantity']) <= 0 ? 'pointer-events:none' : ''; ?>">
                                        <img class="img-prd img-responsive" style="object-fit: cover; object-position: center;" src="<?php echo $row['thumbnail'] ?>" alt="anh san pham ">
                                        <div class="cart-icon <?php echo intval($row['quantity']) > 0 ? 'not-out-of-stock' : ''; ?>" style="<?php echo intval($row['quantity']) <= 0 ? 'display:block; opacity:0.7;' : ''; ?>">
                                            <?php if ($row['quantity'] <= 0) { ?>
                                                <span class="out-of-stock">Hết Hàng</span>
                                                <style>
                                                    .out-of-stock {
                                                        position: absolute;
                                                        top: 50%;
                                                        left: 50%;
                                                        transform: translate(-50%, -50%);
                                                        font-size: large;
                                                        color: #fff;
                                                        padding: 5px 10px;
                                                        border-radius: 5px;
                                                    }
                                                </style>
                                            <?php } else { ?>
                                                <i class="fa fa-shopping-cart cart-icon-btn"></i>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="product-name">
                                        <p class="big"><a href="productdetails.php?data-productid=<?php echo $row["id"]; ?>"><?php echo $row['title'] ?>
                                            </a></p>
                                    </div>
                                </div>

                                <div class="product-price">
                                    <?php
                                    $discountPercent = isset($row['discount']) ? $row['discount'] : 0;
                                    $originalPrice = $row['price'] / (1 - $discountPercent / 100);
                                    $finalPrice = $row['price'];

                                    if ($discountPercent > 0) {
                                        echo "<div style='color: #b2976d; font-size:large;'>" . number_format($finalPrice) . " VND</div>";
                                        echo "<div style='text-decoration: line-through; margin-left:5px; color:gray; font-size:small;' >" . number_format($originalPrice) . " VND</div>";
                                    } else {
                                        // Nếu không có giảm giá, chỉ hiển thị giá gốc
                                        echo number_format($originalPrice) . " VND";
                                    }
                                    ?>
                                </div>
                            </div>

                        <?php
                        }
                        ?>
                    </div>
                    <script>

                    </script>
                    <!-- pagination  -->
                    <?php
                    if (!isset($_GET["input-min"]) && !isset($_GET["input-max"])) {
                    ?>

                        <?php
                        echo '<nav aria-label="Page navigation example">';
                        echo '<ul class="pagination">';
                        if ($current_page > 1) {
                            echo '<li class="page-item"><a class="page-link" href="SanPham.php?' . $filter_query . (!empty($filter_query) ? "&" : "") . 'page=' . ($current_page - 1) . '">Previous</a></li>';
                        }
                        for ($pages = 1; $pages <= $number_of_pages; $pages++) {
                            if ($pages == $current_page) {
                                echo '<li class="page-item active"><a class="page-link" href="SanPham.php?' . $filter_query . (!empty($filter_query) ? "&" : "") . 'page=' . $pages . '">' . $pages . '</a></li>';
                            } else {
                                echo '<li class="page-item"><a class="page-link" href="SanPham.php?' . $filter_query . (!empty($filter_query) ? "&" : "") . 'page=' . $pages . '">' . $pages . '</a></li>';
                            }
                        }
                        if ($current_page < $number_of_pages) {
                            echo '<li class="page-item"><a class="page-link" href="SanPham.php?' . $filter_query . (!empty($filter_query) ? "&" : "") . 'page=' . ($current_page + 1) . '">Next</a></li>';
                        }
                        echo '</ul>';
                        echo '</nav>';
                    } else { ?>
                    <?php
                        echo '<nav aria-label="Page navigation example">';
                        echo '<ul class="pagination">';
                        if ($current_page > 1) {
                            echo '<li class="page-item  "><a class="page-link" href="SanPham.php?input-min=' . $_GET["input-min"] . '&input-max=' . $_GET['input-max'] . '&filter-product=filter-product&page=' . ($current_page - 1) . '">Previous</a></li>';
                        }
                        for ($pages = 1; $pages <= $number_of_pages; $pages++) {
                            if ($pages == $current_page) {
                                echo '<li class="page-item active"><a class="page-link" href="SanPham.php?input-min=' . $_GET["input-min"] . '&input-max=' . $_GET['input-max'] . '&filter-product=filter-product&page=' . $pages . '">' . $pages . '</a></li>';
                            } else {
                                echo '<li class="page-item"><a class="page-link" href="SanPham.php?input-min=' . $_GET["input-min"] . '&input-max=' . $_GET['input-max'] . '&filter-product=filter-product&page=' . $pages . '">' . $pages . '</a></li>';
                            }
                        }
                        if ($current_page < $number_of_pages) {
                            echo '<li class="page-item"><a class="page-link" href="SanPham.php?input-min=' . $_GET["input-min"] . '&input-max=' . $_GET['input-max'] . '&filter-product=filter-product&page=' . ($current_page + 1) . '">Next</a></li>';
                        }
                        echo '</ul>';
                        echo '</nav>';
                    } ?>

                    <!-- End pagination -->
                </div>

                <aside class="side-bar col-md-3 col-lg-3 col-12">
                    <aside class="aside-item">
                        <div class="aside-title">
                            <h2 class="title-head margin-top-0 "><span>Danh Mục</span></h2>
                        </div>
                        <div class="aside-content">
                            <nav class="nav-category">
                                <ul class=" nav-pills">
                                    <li class="nav-item">
                                        <i class="fa fa-caret-right"></i>
                                        <a href="trangchu.php">Trang Chủ</a>
                                    </li>
                                    <li class="nav-item ">
                                        <i class="fa fa-caret-right"></i>
                                        <a href="SanPham.php">Sản Phẩm</a>
                                        <i class="fa fa-angle-down sub-btn"></i>
                                        <div class="sub-menu">
                                            <?php
                                            if ($result->num_rows > 0) {
                                                // Xuất dữ liệu của mỗi hàng
                                                while ($row = $result->fetch_assoc()) {
                                                    echo '<a class="sub-item" href="SanPham.php?category_id=' . $row["id"] . '"> <i class="fa fa-caret-right"></i>' . $row["name"] . '</a>';
                                                }
                                            } else {
                                                echo "Không có loại sản phẩm";
                                            }
                                            ?>
                                        </div>

                                    </li>
                                    <li class="nav-item">
                                        <i class="fa fa-caret-right"></i>
                                        <a href="trangchu.php">Giới Thiệu</a>
                                    </li>
                                    <li class="nav-item">
                                        <i class="fa fa-caret-right"></i>
                                        <a href="trangchu.php">Phản Hồi</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </aside>
                    <form action="SanPham.php" method="get" class="aside-item filter-price">
                        <div class="aside-title">
                            <h2 class="title-head margin-top-0 "><span>Theo mức giá</span></h2>
                        </div>
                        <div class="aside-content filter-group">
                            <div class="price-input d-flex justify-content-center align-items-center">
                                <div class="field">
                                    <input type="number" class="input-min" value="<?php echo isset($_GET['input-min']) ? $_GET['input-min'] : "25000000" ?>" name="input-min">
                                </div>
                                <div class="separator">-</div>
                                <div class="field">
                                    <input type="number" class="input-max" value="<?php echo isset($_GET['input-max']) ? $_GET['input-max'] : '75000000'; ?>" name="input-max">
                                </div>
                            </div>
                            <div class="slider">
                                <div class="progess"></div>
                            </div>
                            <div class="range-input">
                                <input type="range" class="range-min" min="0" max="100000000" value="25000000" step="100000">
                                <input type="range" class="range-max" min="0" max="100000000" value="75000000" step="100000">
                            </div>
                        </div>
                        <div class="btn-filter-price">
                            <button class="btn btn-primary w-100" name="filter-product" value="filter-product" type="submit">Lọc</button>
                        </div>
                    </form>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                    <script src="../js/fillterprice.js"></script>
                    <form action="SanPham.php" method="GET">
                        <aside class="aside-item filter-type">
                            <div class="aside-title">
                                <h2 class="title-head margin-top-0"><span>Theo Loại</span></h2>
                            </div>

                            <div class="aside-content filter-group">
                                <ul class="ps-0">
                                    <?php
                                    // Lấy giá trị category_id từ URL
                                    $selectedCategoryId = isset($_GET['category_id']) ? $_GET['category_id'] : '';

                                    if ($result = $conn->query($sql)) {
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {

                                                $isChecked = ($row["id"] == $selectedCategoryId) ? 'checked' : '';
                                                echo '<li class="filter-item"><span><label for="filter-' . strtolower(str_replace(' ', '-', $row["name"])) . '"><input type="radio" name="category_id" value="' . $row["id"] . '" ' . $isChecked . ' onchange="this.form.submit()"> ' . $row["name"] . '</label></span></li>';
                                            }
                                        } else {
                                            echo "Không có loại sản phẩm";
                                        }
                                    } else {
                                        echo "Lỗi truy vấn: " . $conn->error;
                                    }
                                    ?>
                                </ul>
                            </div>

                            <?php $conn->close(); ?>
                        </aside>
                    </form>
                    <script>

                        const checkboxes = document.querySelectorAll('.filter-item input[type="checkbox"]');

                        function uncheckOthers(currentCheckbox) {
                            checkboxes.forEach((checkbox) => {
                                if (checkbox !== currentCheckbox) {
                                    checkbox.checked = false;
                                }
                            });
                        }

                        checkboxes.forEach((checkbox) => {
                            checkbox.addEventListener('change', function() {
                                if (this.checked) {
                                    uncheckOthers(this);
                                }
                            });
                        });
                    </script>
                </aside>
            </div>

        </div>
        <script>
            $(document).ready(function() {
                $('.sub-btn').click(function() {
                    $(this).next('.sub-menu').slideToggle();
                });
            });
        </script>
        <!-- Footer -->
        <?php include_once('./footer.php'); ?>
        <!-- End Footer -->
    </div>

    <!-- Cart -->
    <?php include_once("./cart.php"); ?>
</body>

</html>