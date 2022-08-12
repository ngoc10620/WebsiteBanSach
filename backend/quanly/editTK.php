<?php
include '../template/connection.php';
$title = 'Sửa tài khoản';
include '../template/tpl_header.php';

$MaTK = isset($_GET['MaTK']) ? $_GET['MaTK'] : '';
$query_user = mysqli_query($conn,"SELECT * FROM taikhoan WHERE MaTK = $MaTK");
$row_user = mysqli_fetch_assoc($query_user);
// Mảng ghi lỗi
$error = array();
// Check email format
function is_email($str) {
    return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
}
// Check phone number format
function is_phonenumber($str){
    return (!preg_match("/^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/", $str)) ? FALSE : TRUE;
}
$username = isset($row_user['TenDangNhap']) ? $row_user['TenDangNhap'] : '';
$email = isset($row_user['Email']) ? $row_user['Email'] : '';
$fullname = isset($row_user['HoTen']) ? $row_user['HoTen'] : '';
$phone = isset($row_user['SoDienThoai']) ? $row_user['SoDienThoai'] : '';
$address = isset($row_user['DiaChi']) ? $row_user['DiaChi'] : '';
$role = isset($row_user['VaiTro']) ? $row_user['VaiTro'] : '';

if(isset($_POST['update'])){
    // Lấy dữ liệu
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $fullname = (isset($_POST['fullname'])) ? $_POST['fullname'] : '';
    $phone = (isset($_POST['phone'])) ? $_POST['phone'] : '';
    $address = (isset($_POST['address'])) ? $_POST['address'] : '';
    $role = isset($_POST['role']) ? $_POST['role'] : '';
    
    // Kiểm tra định dạng email
    if(!is_email($email)){
        $error['email'] = 'Email này không hợp lệ';
    }
    else if($email != $row_user['Email']){
        // Kiểm tra email đã có người dùng
        if(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM taikhoan WHERE Email='$email'")) > 0){
            $error['email'] = 'Email này đã có người dùng';
        }
    }
    if($phone != ''){
        if(!is_phonenumber($phone)){
            $error['phone'] = 'Số điện thoại này không hợp lệ';
        }
    }
    if(!$error){
        $sql_update = "UPDATE taikhoan SET HoTen = '$fullname', SoDienThoai = '$phone', Email = '$email', DiaChi = '$address', VaiTro = '$role' WHERE MaTK = '$MaTK'";
        $query_update = mysqli_query($conn,$sql_update);
        if($query_update){
            $message = 'Cập nhật thông tin thành công.';
        }
        else{
            $message = 'Cập nhật chưa thành công'.mysqli_error($conn);
        }
    }
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-buttons-bs4/2.0.0/buttons.bootstrap4.min.css" integrity="sha512-hzvGZ3Tzqtdzskup1j2g/yc+vOTahFsuXp6X6E7xEel55qInqFQ6RzR+OzUc5SQ9UjdARmEP0g2LDcXA5x6jVQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-responsive-bs4/2.2.5/responsive.bootstrap4.min.css" integrity="sha512-Yy2EzOvLO8+Vs9hwepJPuaRWpwWZ/pamfO4lqi6t9gyQ9DhQ1k3cBRa+UERT/dPzIN/RHZAkraw6Azs4pI0jNg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .error {
        color: #ff0000;
        font-style: italic;
        font-weight: normal;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0"><?php echo $title; ?></h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="taikhoan.php">Tài khoản</a></li>
						<li class="breadcrumb-item active"><?php echo $title; ?></li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <form method="post" id="EditTK" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <span style="color: #ff0000; font-style: italic; font-weight: normal;"><?php echo isset($message) ? $message : ''; ?></span>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="form-group">
                                <label for="username">Tên đăng nhập</label>
                                <input type="text" name="username" class="form-control col-sm-6" disabled placeholder="Tên đăng nhập" value="<?php echo isset($row_user['TenDangNhap']) ? $row_user['TenDangNhap'] : '';?>">
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <p class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" class="form-control col-sm-6" required placeholder="Email" value="<?php echo isset($email) ? $email : '';?>">
                                <span class="error"><?php echo isset($error['email']) ? $error['email'] : ''; ?></span>
                            </p>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="col-sm-6">   
                            <p class="form-group">
                                <label for="fullname">Họ và tên</label>
                                <input type="text" name="fullname" class="form-control col-sm-6" placeholder="Họ và tên" value="<?php echo isset($fullname) ? $fullname : ''; ?>">
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <p class="form-group">
                                <label for="phone">Số điện thoại</label>
                                <input type="text" name="phone" class="form-control col-sm-6" placeholder="Số điện thoại" value="<?php echo isset($phone) ? $phone : '';?>">
                                <span class="error"><?php echo isset($error['phone']) ? $error['phone'] : ''; ?></span>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">   
                            <p class="form-group">
                                <label for="address">Địa chỉ</label>
                                <input type="text" name="address" class="form-control col-sm-6" placeholder="Địa chỉ" value="<?php echo isset($address) ? $address : ''; ?>">
                            </p>
                        </div>
                        <div class="col-sm-6">   
                            <p>
                                <label for="role">Vai trò</label>
                                <select name="role" id="role" class="form-control col-sm-6" required />
                                    <option value="">Chọn vai trò</option>
                                    <option value="admin" <?php echo ($role =='admin') ? 'selected' : '';?>>Quản lý</option>
                                    <option value="sale" <?php echo ($role =='sale') ? 'selected' : '';?>>Nhân viên bán hàng</option>
                                    <option value="member" <?php echo ($role =='member') ? 'selected' : '';?>>Thành viên</option>
                                </select>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-9" style="text-align:center;margin-bottom:20px;">
                        <a href="<?php if(in_array($taikhoan['VaiTro'], array('admin'))){ echo 'taikhoan.php';} else{ echo 'index.php';}?>"><button type="button" class="btn btn-secondary">Trở lại</button></a>
                        <button type="submit" name="update" class="btn btn-primary">Cập nhật</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php include '../template/tpl_footer.php';?>