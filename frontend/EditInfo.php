<?php
ob_start();?>
<?php include './include/connection.php';?>
<?php 
if(!isset($_SESSION['username'])){
    header('Location: notLogin.php');
}
?>
<?php
    $title = "Chỉnh sửa thông tin";
?>
<?php include './include/header.php';?>
<?php include './include/mainnav.php';?>
<?php
$error = array();
function is_email($str) {
    return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
}
function is_phonenumber($str){
    return (!preg_match("/^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/", $str)) ? FALSE : TRUE;
}
$user = $_SESSION['username'];
$row_user = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM taikhoan WHERE TenDangNhap = '$user'"));
$fullname = (isset($row_user['HoTen'])) ? $row_user['HoTen'] : '';
$phone = (isset($row_user['SoDienThoai'])) ? $row_user['SoDienThoai'] : '';
$email = $row_user['Email'];
$address = (isset($row_user['DiaChi'])) ? $row_user['DiaChi'] : '';
if(isset($_POST['update']))
{
    // Lấy dữ liệu
    $fullname = isset($_POST['fullname']) ? $_POST['fullname'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    //Kiểm tra người dùng đã nhập liệu đầy đủ
    if(empty($email)){
        $error['email'] = 'Email là bắt buộc';
    }
    // Kiểm tra định dạng email
    else if(!is_email($email)){
        $error['email'] = 'Email này không hợp lệ';
    }
    else if($email != $row_user['Email']){
    // Kiểm tra email đã có người dùng
        if(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM taikhoan WHERE Email='$email'")) > 0){
            $error['email'] = 'Email này đã có người dùng';}
    }
    if($phone != ''){
        if(!is_phonenumber($phone)){
            $error['phone'] = 'Số điện thoại này không hợp lệ';
        }
    }
    if(!$error){
        $sql_update = "UPDATE taikhoan SET HoTen = '$fullname', SoDienThoai = '$phone', Email = '$email', DiaChi = '$address' WHERE TenDangNhap = '$user'";
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
<div class="container">
    <div class="bookdetailwrap">
        <div class="pageheader">
            <h1>Chỉnh sửa thông tin</h1>
        </div>
        <article class="form">
            <form method="post" action="EditInfo.php" novalidate="novalidate">
                <span class="message"><?php echo isset($message) ? $message : ''; ?></span>
                <p>
                    <label for="fullname">Họ và tên</label>
                    <input type="text" class="text-box single-line" id="fullname" name="fullname" value="<?php echo isset($fullname) ? $fullname : ''; ?>">
                </p>
                <p>
                    <label for="phone">Số điện thoại</label>
                    <input type="text" class="text-box single-line" id="phone" name="phone" value="<?php echo isset($phone) ? $phone : ''; ?>">
                    <span class="error"><?php echo isset($error['phone']) ? $error['phone'] : ''; ?></span>
                </p>
                <p>
                    <label for="email">Email</label>
                    <input type="text" class="text-box single-line" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
                    <span class="error"><?php echo isset($error['email']) ? $error['email'] : ''; ?></span>
                </p>
                <p>
                    <label for="address">Địa chỉ</label>
                    <input type="text" class="text-box" id="address" name="address" value="<?php echo isset($address) ? $address : ''; ?>">
                </p>
                <p>
                    <input type="submit" class="btn" value="Cập nhật" name="update">
                </p>
            </form>
        </article>
    </div>
</div>
<?php include './include/footer.php';?>
<?php ob_flush();?>