<?php include './include/connection.php';?>
<?php
    $title = "Đăng ký";
?>
<?php include './include/header.php';?>
<?php include './include/mainnav.php';?>
<?php
$error = array();
function is_email($str) {
    return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
}
if(isset($_POST['submit']))
{
    // Lấy dữ liệu
    $username = isset($_POST['user']) ? $_POST['user'] : '';
    $password = isset($_POST['pass']) ? $_POST['pass'] : '';
    $cfpassword = isset($_POST['cfpass']) ? $_POST['cfpass'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    //Validation
    if (empty($username)){
        $error['username'] = 'Tên đăng nhập là bắt buộc';
    }
    else if(mysqli_num_rows(mysqli_query($conn,"SELECT TenDangNhap FROM taikhoan WHERE TenDangNhap='$username'")) > 0){
        $error['username'] = 'Tên đăng nhập này đã có người dùng';
    }
    if(empty($password)){
        $error['password'] = 'Mật khẩu là bắt buộc';
    }
    else if(strlen($password) < 6 || strlen($password) > 20){
        $error['password'] = 'Mật khẩu có độ dài từ 6 - 20 ký tự';
    }
    if(empty($cfpassword)){
        $error['cfpassword'] = 'Xác nhận lại mật khẩu';
    }
    else if(strlen($cfpassword) < 6 || strlen($cfpassword) > 20){
        $error['cfpassword'] = 'Xác nhận mật khẩu có độ dài từ 6 - 20 ký tự';
    }
    else if(strcmp($password, $cfpassword) != 0){
        $error['cfpassword'] = 'Mật khẩu và xác nhận mật khẩu không trùng nhau';
    }
    if(empty($email)){
        $error['email'] = 'Email là bắt buộc';
    }
    else if(!is_email($email)){
        $error['email'] = 'Email này không hợp lệ';
    }
    else if(mysqli_num_rows(mysqli_query($conn,"SELECT Email FROM taikhoan WHERE Email='$email'")) > 0){
        $error['email'] = 'Email này đã có người dùng';
    }
    // Lưu dữ liệu
    if(!$error){
        $sql_signin = "INSERT INTO taikhoan (TenDangNhap,MatKhau,Email,VaiTro) VALUES ('$username','$password','$email','member')";
        $query_signin = mysqli_query($conn,$sql_signin);
        if($query_signin){
            $row_user = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM taikhoan WHERE TenDangNhap = '$username'"));
            $matk = $row_user['MaTK'];
            $query_addgh = mysqli_query($conn,"INSERT INTO giohang (MaTK) VALUES ('$matk')");
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $message = 'Đăng ký tài khoản thành công. Trở về <a href="index.php">Trang chủ</a>';
        }
        else{
            $message = 'Đăng ký bị lỗi';
        }
    }
}
?>
<div class="container">
    <div class="bookdetailwrap">
        <div class="pageheader">
            <h1>Đăng ký</h1>
        </div>
        <article class="form">
            <form action="signin.php" id="signin" method="post" novalidate="novalidate">
                <span class="message"><?php echo isset($message) ? $message : ''; ?></span>
                <p>
                    <label for="username">Tên đăng nhập</label>
                    <input type="text" class="text-box single-line" id="username" name="user" value="<?php echo isset($username) ? $username : ''; ?>">
                    <span class="error"><?php echo isset($error['username']) ? $error['username'] : ''; ?></span>
                </p>
                <p>
                    <label for="password">Mật khẩu</label>
                    <input type="password" class="text-box single-line password" id="password" name="pass" value="<?php echo isset($password) ? $password : ''; ?>">
                    <span class="error"><?php echo isset($error['password']) ? $error['password'] : ''; ?></span>
                </p>
                <p>
                    <label for="confirmpass">Xác nhận mật khẩu</label>
                    <input type="password" class="text-box single-line password" id="confirmpass" name="cfpass" value="<?php echo isset($cfpassword) ? $cfpassword : ''; ?>">
                    <span class="error"><?php echo isset($error['cfpassword']) ? $error['cfpassword'] : ''; ?></span>
                </p>
                <p>
                    <label for="email">Email</label>
                    <input type="text" class="text-box single-line" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
                    <span class="error"><?php echo isset($error['email']) ? $error['email'] : ''; ?></span>
                </p>
                <p>
                    <input type="submit" class="btn" value="Đăng ký" name="submit">
                </p>
                <p>Bạn đã có tài khoản? Hãy <a href="login.php" class="btn"><strong>Đăng nhập</strong></a></p>
            </form>
        </article>
    </div>
</div>
<?php include './include/footer.php';?>