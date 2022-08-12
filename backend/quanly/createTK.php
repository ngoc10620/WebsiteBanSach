<?php
include '../template/connection.php';
$title = 'Thêm tài khoản';
include '../template/tpl_header.php';

$error = array();
function is_email($str) {
    return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
}
if(isset($_POST['create'])){
    // Lấy dữ liệu
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $pass = isset($_POST['pass']) ? $_POST['pass'] : '';
    $cfpass = isset($_POST['cfpass']) ? $_POST['cfpass'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $fullname = (isset($_POST['fullname'])) ? $_POST['fullname'] : '';
    $phone = (isset($_POST['phone'])) ? $_POST['phone'] : '';
    $address = (isset($_POST['address'])) ? $_POST['address'] : '';
    $role = $_POST['role'];
    // Kiểm tra tên đăng nhập đã có người dùng
    if(mysqli_num_rows(mysqli_query($conn,"SELECT TenDangNhap FROM taikhoan WHERE TenDangNhap='$username'")) > 0){
        $error['username'] = 'Tên đăng nhập này đã có người dùng';
    }
    // Kiểm tra định dạng email
    if(!is_email($email)){
        $error['email'] = 'Email này không hợp lệ';
    }
    // Kiểm tra email đã có người dùng
    if(mysqli_num_rows(mysqli_query($conn,"SELECT Email FROM taikhoan WHERE Email='$email'")) > 0){
        $error['email'] = 'Email này đã có người dùng';
    }
    if(!$error){
        $sql_create = "INSERT INTO taikhoan (TenDangNhap,MatKhau,HoTen,SoDienThoai,Email,DiaChi,VaiTro) VALUES ('$username','$pass','$fullname','$phone','$email','$address','$role')";
        $query_create = mysqli_query($conn,$sql_create);
        if($query_create){
            echo '<script>alert("Thêm tài khoản thành công."); window.location = "taikhoan.php";</script>';
        }
        else{
            echo '<script>alert("Thêm tài khoản chưa thành công."); window.location = "createTK.php";</script>';
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
            <form method="post" id="CreateTK" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="form-group">
                                <label for="username">Tên đăng nhập</label>
                                <input type="text" name="username" class="form-control col-sm-6" placeholder="Tên đăng nhập" value="<?php echo isset($username) ? $username : '';?>">
                                <span class="error"><?php echo isset($error['username']) ? $error['username'] : ''; ?></span>
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <p class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" class="form-control col-sm-6" placeholder="Email" value="<?php echo isset($email) ? $email : '';?>">
                                <span class="error"><?php echo isset($error['email']) ? $error['email'] : ''; ?></span>
                            </p>
                        </div>
                    </div>
                    <div class="row">    
                        <div class="col-sm-6">
                        <p class="form-group">
                                <label for="pass">Mật khẩu</label>
                                <input type="password" name="pass" id="pass" class="form-control password col-sm-6" placeholder="Mật khẩu" value="<?php echo isset($pass) ? $pass : '';?>">
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <p class="form-group">
                                <label for="username">Xác nhận mật khẩu</label>
                                <input type="password" name="cfpass" class="form-control password col-sm-6" placeholder="Nhập lại mật khẩu" value="<?php echo isset($cfpass) ? $cfpass : '';?>">
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
                                <input type="text" name="phone" class="form-control col-sm-6" placeholder="Số điện thoại" value="<?php echo isset($phone) ? $phone : ''; ?>">
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
                                <option selected value="">Chọn vai trò</option>
                                <option value="admin" >Quản lý</option>
                                <option value="sale">Nhân viên bán hàng</option>
                                <option value="member">Thành viên</option>
                            </select>
                        </p>
</div>
                    </div>
                    <div class="row">
                        <button type="submit" name="create" class="btn btn-primary">Thêm mới</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$().ready(function() {
$("#CreateTK").validate({
    errorClass: 'error',
    errorPlacement: function (error, element) {
      error.insertAfter(element);
    },
    rules: {
        email: {
            required: true,
            email: true
        },
        username: "required",
        pass: {
            required: true,
            minlength: 6,
            maxlength: 20
        },
        cfpass: {
            required: true,
            minlength: 6,
            maxlength: 20,
            equalTo: "#pass"
        }
    },
    messages: {
        email: {
            required: 'Vui lòng nhập địa chỉ email',
            email: 'Định dạng email không đúng'
        },
        username: 'Vui lòng nhập tên đăng nhập',
        pass: {
            required: 'Vui lòng nhập mật khẩu',
            minlength: 'Mật khẩu phải từ 6-20 ký tự',
            maxlength: 'Mật khẩu phải từ 6-20 ký tự'
        },
        cfpass: {
            required: 'Vui lòng nhập lại mật khẩu',
            minlength: 'Xác nhận mật khẩu nhập lại phải từ 6-20 ký tự',
            maxlength: 'Xác nhận mật khẩu phải từ 6-20 ký tự',
            equalTo: 'Mật khẩu và xác nhận mật khẩu không trùng nhau'
        },
        role: {
            required: 'Vui lòng chọn vai trò cho tài khoản'
        }
    }
    });
});
</script>
<?php include '../template/tpl_footer.php';?>