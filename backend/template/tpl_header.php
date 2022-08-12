<?php 
	ob_start();
	$taikhoan = array();
	if((isset($_SESSION['username'])) && (isset($_SESSION['password']))) {
		$session_username = $_SESSION['username'];
		$session_password = $_SESSION['password'];
		$result = mysqli_query($conn,"SELECT * FROM taikhoan WHERE TenDangNhap = '$session_username' AND MatKhau = '$session_password'");
		if (mysqli_num_rows($result) > 0) {
			$taikhoan = mysqli_fetch_assoc($result);
		}
		else {
			setcookie('username', '', time() - (365*30*86400), "/"); 
			setcookie('token', '', time() - (365*30*86400), "/"); 
			session_destroy();
			echo '<script>alert("Token hết hạn, vui lòng đăng nhập lại!");</script>';
			header('Location: ../../login.php');
			die();
		}
	}
	else {
		header('Location: ../../login.php');
		die();
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $title;?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Favicon -->
	<link href="../../favicon.ico" rel="icon">
	<link href="../../favicon.ico" rel="shortcut icon">

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- Theme style -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css" integrity="sha512-IuO+tczf4J43RzbCMEFggCWW5JuX78IrCJRFFBoQEXNvGI6gkUw4OjuwMidiS4Lm9Q2lILzpJwZuMWuSEeT9UQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- icheck bootstrap -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css" integrity="sha512-8vq2g5nHE062j3xor4XxPeZiPjmRDh6wlufQlfC6pdQ/9urJkU07NM0tEREeymP++NczacJ/Q59ul+/K2eYvcg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	
	<!-- jQuery -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">

		<!-- Preloader -->
		<!-- <div class="preloader flex-column justify-content-center align-items-center">
			<img class="animation__shake" src="../images/logo-hieu-sach.png" alt="Nhã Nam" height="200" width="200">
		</div> -->

		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-white navbar-light">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				</li>
			</ul>

			<!-- Right navbar links -->
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link" href="../../frontend/logout.php" role="button">
						<i class="fas fa-sign-out-alt"></i>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-widget="fullscreen" href="#" role="button">
						<i class="fas fa-expand-arrows-alt"></i>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.navbar -->

        <!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<a href="../quanly/index.php" class="brand-link">
				<img src="../images/logo-nha-nam.jpg" alt="Nhã Nam" class="brand-image">
				<span class="brand-text font-weight-light">Nhã Nam</span>
			</a>

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
						<!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
						<li class="nav-item">
							<?php if(in_array($taikhoan['VaiTro'], array('admin'))){ ?>
							<a href="../quanly/taikhoan.php" class="nav-link">
								<i class="nav-icon fas fa-user"></i>
								<p>
									Quản lý tài khoản
								</p>
							</a>
							<?php }else{ ?>
							<a href="editTK.php?MaTK=<?php echo $taikhoan['MaTK'];?>" class="nav-link">
								<i class="nav-icon fas fa-user"></i>
								<p>
									Chỉnh sửa thông tin
								</p>
							</a>
							<?php } ?>
						</li>
						<?php if(in_array($taikhoan['VaiTro'], array('admin'))){ ?>
						<li class="nav-item">
							<a href="../quanly/danhmuc.php" class="nav-link">
								<i class="nav-icon fas fa-list"></i>
								<p>
									Quản lý danh mục
								</p>
							</a>
						</li>
						<?php } ?>
						<li class="nav-item">
							<a href="../quanly/sach.php" class="nav-link">
								<i class="nav-icon fas fa-book"></i>
								<p>
									Quản lý sách
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="../quanly/donhang.php" class="nav-link">
								<i class="nav-icon fas fa-receipt"></i>
								<p>
									Quản lý đơn hàng
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="../quanly/tintuc.php" class="nav-link">
								<i class="nav-icon fas fa-newspaper"></i>
								<p>
									Cập nhật tin tức
								</p>
							</a>
						</li>
						<?php if(in_array($taikhoan['VaiTro'], array('admin'))){ ?>
						<li class="nav-item">
							<a href="#" class="nav-link">
								<i class="nav-icon fas fa-chart-column"></i>
								<p>
									Thống kê
									<i class="fas fa-angle-left right"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="../thongke/sachbanchay.php" class="nav-link">
										<i class="fas fa-chevron-right nav-icon"></i>
										<p>Thống kê sách bán chạy</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="../thongke/doanhthu.php" class="nav-link">
										<i class="fas fa-chevron-right nav-icon"></i>
										<p>Thống kê doanh thu</p>
									</a>
								</li>
							</ul>
						</li>
						<?php } ?>
					</ul>
				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>