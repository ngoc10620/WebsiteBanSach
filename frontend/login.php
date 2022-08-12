<?php
ob_start();?>
<?php include './include/connection.php';?>
<?php
    $title = "Đăng nhập";
?>
<?php include './include/header.php';?>
<?php include './include/mainnav.php';?>
<?php
$error = array();
if(isset($_POST['submit']))
{
    // Lấy dữ liệu
    $username = isset($_POST['user']) ? $_POST['user'] : '';
    $password = isset($_POST['pass']) ? $_POST['pass'] : '';
    //Kiểm tra người dùng đã nhập liệu đầy đủ
    if(empty($username)){
        $error['username'] = 'Tên đăng nhập là bắt buộc';
    }
    //Kiểm tra tên đăng nhập có tồn tại không
    else if (mysqli_num_rows(mysqli_query($conn,"SELECT TenDangNhap FROM taikhoan WHERE TenDangNhap='$username'")) == 0) {
        $error['username'] = 'Tên đăng nhập này không tồn tại';
    }
    else{
    $row_user = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM taikhoan WHERE TenDangNhap = '$username'"));
    if(empty($password)){
        $error['password'] = 'Mật khẩu là bắt buộc';
    }
    else if ($password != $row_user['MatKhau']) {
        $error['password'] = 'Mật khẩu không đúng';
    }
}
    if(!$error){
        if($row_user['VaiTro'] == 'member'){
            header('Location: index.php');
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
        }else {
            header('Location: ../backend/quanly/index.php');
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
        }
    }
}
?>
<div class="container">
    <div class="bookdetailwrap">
        <div class="pageheader">
            <h1>Đăng nhập</h1>
        </div>
        <article class="form">
            <form method="post" action="login.php" novalidate="novalidate">
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
                    <input type="submit" class="btn" value="Đăng nhập" name="submit">
                </p>
                <p>Đã có tài khoản? Hãy <a href="signin.php" class="btn"><strong>Đăng ký</strong></a></p>
            </form>
        </article>
    </div>
</div>
<?php include './include/footer.php';?>
<?php ob_flush();?>