<?php
session_start();

require_once __DIR__ . '/../database/connection.php';

function normalizeAvatarPath($path)
{
	$projectBase = '/shopjewelry3';

	if (empty($path)) {
		return $projectBase . '/assets/imgs/default-avatar.png';
	}

	if (strpos($path, '../') === 0) {
		return $projectBase . '/' . ltrim(str_replace('../', '', $path), '/');
	}

	if (strpos($path, '/') === 0) {
		return $path;
	}

	if (strpos($path, 'assets/') === 0) {
		return $projectBase . '/' . $path;
	}

	return $projectBase . '/' . ltrim($path, '/');
}

$row = null;
if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
	try {
		$db = new Database();
		$conn = $db->connect();

		$stmt = $conn->prepare("SELECT * FROM `user` WHERE id = :id LIMIT 1");
		$stmt->execute([':id' => $_SESSION['id']]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
	} catch (Exception $e) {
		// nếu có lỗi DB thì log hoặc debug ngắn
		error_log("Failed to fetch user: " . $e->getMessage());
		$row = null;
	}
}

$avatar_raw = $row['avatar'] ?? $_SESSION['avatar'] ?? null;
$avatar_url = normalizeAvatarPath($avatar_raw);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Thông tin khách hàng</title>

	<!-- Fontawesome -->
	<link rel="stylesheet" href="../public/assets/icons/css/all.min.css">

	<!-- CDN Boostrap Css -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />

	<!-- CDN Boostrap Js  -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" crossorigin="anonymous"></script>

	<!-- CSS -->
	<link rel="stylesheet" href="../public/assets/css/config.css">
	<link rel="stylesheet" href="../public/assets/css/customerinfo.css">

	<!-- JQUERY -->
	<script src="../public/assets/libs/jquery-3.7.1.min.js"></script>

	<!-- Js -->
	<script src="../public/js/customerinfo.js" type="module"></script>
	<script src="../public/js/cart.js" defer></script>
</head>

<body>
	<?php include_once("./header.php") ?>

	<div class="container customerinfo-wrap">
		<div class="row">
			<div class="header mb-2">
				<a href="../templates/trangchu.php">Trang chủ</a> >
				<span style="color: #d4af37; font-weight: 600;"> Thông tin khách hàng</span>
			</div>
		</div>
		<!-- Content -->
		<section class="mt-3">
			<div class="row">
				<div class="col-md-3">
					<h5 class="customerinfo-header" style="letter-spacing: 2px;">
						TRANG TÀI KHOẢN
					</h5>
					<p style="font-weight: 600; font-size: 14px;">Xin chào, <span style="color: #d4af37; font-weight: 700"><?php echo '' . $_SESSION["fullname"] . '!'; ?></span></p>
					<div class="btns-group">
						<button type="button" class="btn mb-2" data-customerinfo__info>Thông tin tài khoản</button>
						<button type="button" class="btn mb-2" data-customerinfo__orders>Đơn hàng của bạn</button>
						<button type="button" class="btn mb-2" data-customerinfo__changepwd>Đổi mật khẩu</button>
					</div>
				</div>

				<div class="col-md-9 ps-md-5">
					<h5 class="customerinfo-header" style="letter-spacing: 2px;">
						THÔNG TIN TÀI KHOẢN
					</h5>
					<div class="customerinfo-content">
						<div class="customerinfo__info d-none mb-3">

							<!-- Ảnh đại diện -->
							<div class="mb-3">
								<h6 style="font-weight:600;">Ảnh đại diện</h6>
								<img id="avatarPreview"
									src="<?php echo htmlspecialchars($avatar_url); ?>"
									style="width:120px; height:120px; border-radius:50%; object-fit:cover; border:2px solid #ccc;">

							</div>

							<!-- Form upload avatar -->
							<form action="../includes/update_avatar.php"
								method="POST" enctype="multipart/form-data">

								<label class="form-label">Đổi avatar:</label>
								<input type="file" name="avatar" id="avatarInput" class="form-control"
									accept="image/*">

								<button type="submit"
									class="btn btn-primary mt-3"
									style="background-color:#d4af37; border:none;">
									Lưu avatar
								</button>
							</form>

							<hr>

							<!-- Các thông tin khác -->
							<span style="font-weight: 600; font-size: 18px;">Họ tên: </span>
							<span style="font-size: 18px;"><?php echo $_SESSION["fullname"]; ?></span>
							<br />

							<span style="font-weight: 600; font-size: 18px;">Email: </span>
							<span style="font-size: 18px;"><?php echo $_SESSION["useremail"]; ?></span>
						</div>


						<div class="customerinfo__orders d-none">
							<table class="table table-striped">
								<thead style="background-color: #d4af37; color: #fff;">
									<tr class="text-center">
										<th>Đơn hàng</th>
										<th>Ngày</th>
										<th>Địa chỉ</th>
										<th>Tổng tiền</th>
										<th>Thanh toán</th>
										<th>Trạng thái</th>
									</tr>
								</thead>
								<tbody class="customerinfo__orders-tbody">
									<!-- Using JavaScript to render -->
								</tbody>
							</table>
						</div>

						<div class="customerinfo__changepwd d-none">
							<div class="form-group">
								<label for="oldpwd" style="font-weight: 600;">Mật khẩu cũ<span class="text-danger"> *</span></label>
								<input type="password" id="oldpwd" class="w-50">
								<div class="error-message"></div>
							</div>
							<div class="form-group">
								<label for="newpwd" style="font-weight: 600;">Mật khẩu mới<span class="text-danger"> *</span></label>
								<input type="password" id="newpwd" class="w-50">
								<div class="error-message"></div>
							</div>
							<div class="form-group">
								<label for="verifypwd" style="font-weight: 600;">Xác nhận lại mật khẩu<span class="text-danger"> *</span></label>
								<input type="password" id="verifypwd" class="w-50">
								<div class="error-message"></div>
							</div>
							<button type="button" class="btn btn-outline-none resetpwd-btn mb-5" style="color: #fff; background-color: #d4af37;">Đặt lại mật khẩu</button>
						</div>

						<!-- Order details (ẩn mặc định) -->
						<div class="customerinfo_orderdetails d-none"></div>
					</div>
				</div>
			</div>
		</section>
	</div>

	<?php include_once("./footer.php") ?>
	<!-- Cart -->
	<?php include_once("./cart.php"); ?>
</body>

</html>