<?php
ob_start();?>
<?php include './include/connection.php';?>
<?php 
if(!isset($_SESSION['username'])){
    header('Location: notLogin.php');
}
else{
    $user = $_SESSION['username'];
}
?>
<?php
    $title = "Đặt hàng";
?>
<?php include './include/header.php';?>
<style>
.customer-info input[type="text"],
.customer-info textarea{
    padding: 5px;
    font-size: 12px;
    width: 350px;
    border-radius: 3px;
    border: 1px solid #ccc;
}
table{
    border-collapse: separate;
    border-spacing: 0;
    width: 100%;
}
tr:last-child td{
    border-top: 1px solid #ccc;
}
tr:first-child th{
    border-bottom: 1px solid #ccc;
}
th{
    text-align: center;
    color: #444;
    padding: 5px;
}
td{
    text-align: center;
    padding: 5px;
    vertical-align: top;
}
.cart-name{
    color: #cf6b50;
    font-weight: bold;
}
.button-wrap{
    margin-top:20px;
}
.button-wrap .checkout{
    float:right;
    margin-right: 60px;
    font-weight: bold;
    font-size:14px;
    text-transform: uppercase;
}
.out{
    margin-left:40px;
    background: none repeat scroll 0 0 #eee;
    color: #666;
    border:0;
    font-weight: bold;
    font-size:14px;
    text-transform: uppercase;
}
.out:hover{
    background: #ccc;
    color: #666;
}
</style>
<?php include './include/mainnav.php';?>
<?php
$MaSach = isset($_GET['MaSach']) ? $_GET['MaSach'] : '';
$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : 1;
$row_user = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM taikhoan WHERE TenDangNhap = '$user'"));
$customer = (isset($row_user['HoTen'])) ? $row_user['HoTen'] : '';
$phone = (isset($row_user['SoDienThoai'])) ? $row_user['SoDienThoai'] : '';
$email = $row_user['Email'];
$address = (isset($row_user['DiaChi'])) ? $row_user['DiaChi'] : '';
if(!empty($MaSach)){
    $query_sach1 = mysqli_query($conn,"SELECT * FROM sach WHERE MaSach='$MaSach'");
}
else{
    $query_sach2 = mysqli_query($conn,"SELECT * FROM chitietgiohang ct INNER JOIN giohang gh ON ct.MaGioHang = gh.MaGioHang INNER JOIN taikhoan tk ON gh.MaTK = tk.MaTK WHERE tk.TenDangNhap='$user'");
}
$error = array();
function is_email($str) {
    return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
}
function is_phonenumber($str){
    return (!preg_match("/^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/", $str)) ? FALSE : TRUE;
}
if(isset($_POST['submit']))
{
    // Lấy dữ liệu
    $customer = isset($_POST['customer']) ? $_POST['customer'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $note = isset($_POST['note']) ? $_POST['note'] : '';
    $totalPrice = isset($_POST['totalPrice']) ? $_POST['totalPrice'] : '';
    $MaTK = isset($_POST['matk']) ? $_POST['matk'] : '';
    // Kiểm tra định dạng email
    if(!is_email($email)){
        $error['email'] = 'Email này không hợp lệ';
    }
    if(!is_phonenumber($phone)){
        $error['phone'] = 'Số điện thoại này không hợp lệ';
    }
    if(!$error){
        $sql_add = "INSERT INTO donhang(NgayLap,HoTenNguoiNhan,SDTNguoiNhan,EmailNguoiNhan,DiaChiNguoiNhan,PhiVanChuyen,TongTien,TinhTrang,GhiChu,MaTK) VALUES(DATE(NOW()),'$customer','$phone','$email','$address',22000,'$totalPrice','pending','$note','$MaTK')";
        $query_add = mysqli_query($conn,$sql_add);
        if($query_add){
            $dh = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM donhang WHERE MaTK='$MaTK' ORDER BY MaDH DESC limit 1"));
            $madh = $dh['MaDH'];
            if(!isset($query_sach2)){
                $MaSach = isset($_POST['id']) ? $_POST['id'] : '';
                $query_ctdh = mysqli_query($conn,"INSERT INTO chitietdonhang(MaDH,MaSach,SoLuong,ThanhTien) VALUES('$madh','$MaSach','$quantity','$totalPrice')");
                if($query_ctdh){
                    $row_sach = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM sach WHERE MaSach='$MaSach'"));
                    $new_tonkho = $row_sach['SoLuongCo'] - $quantity;
                    $new_ban = $row_sach['SoLuongBan'] + $quantity;
                    $query_update_tonkho = mysqli_query($conn,"UPDATE sach SET SoLuongCo = '$new_tonkho', SoLuongBan = '$new_ban' WHERE MaSach='$MaSach'");
                }
            }
            else{
                // $query_sach2 = mysqli_query($conn,"SELECT * FROM chitietgiohang ct INNER JOIN giohang gh ON ct.MaGioHang = gh.MaGioHang INNER JOIN taikhoan tk ON gh.MaTK = tk.MaTK WHERE tk.TenDangNhap='$user'");
                while($row_ctgh=mysqli_fetch_assoc($query_sach2)){
                    $query_ctdh = mysqli_query($conn,"INSERT INTO chitietdonhang(MaDH,MaSach,SoLuong,ThanhTien) VALUES('$madh','$row_ctgh[MaSach]','$row_ctgh[SoLuong]','$row_ctgh[ThanhTien]')");
                    if($query_ctdh){
                        $query_xoa_ctgh = mysqli_query($conn,"DELETE FROM chitietgiohang WHERE MaCTGH='$row_ctgh[MaCTGH]'");
                        $row_sach = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM sach WHERE MaSach='$row_ctgh[MaSach]'"));
                        $new_tonkho = $row_sach['SoLuongCo'] - $row_ctgh['SoLuong'];
                        $new_ban = $row_sach['SoLuongBan'] + $row_ctgh['SoLuong'];
                        $query_update_tonkho = mysqli_query($conn,"UPDATE sach SET SoLuongCo = '$new_tonkho', SoLuongBan = '$new_ban' WHERE MaSach='$row_ctgh[MaSach]'");
                    }
                }
            }
            header("Location: checkout-success.php");
        }
        else{
            echo "<script>alert('Có lỗi. Mua hàng thất bại');</script>";
        }
    }
}
?>
<div class="container">
    <div class="bookdetailwrap">
        <div class="pageheader">
            <h1>Đặt hàng</h1>
        </div>
        <div class="customer-info">
            <h3 class="checkout-title">Thông tin người mua</h3>
            <form id="information" method="post">
                <input type="hidden" name="matk" value="<?php echo $row_user['MaTK'];?>">
                <p>
                    <label style="float: left;width: 150px;" for="customer">Họ và tên</label>
                    <input required class="textInfo" type="text" name="customer" id="customer" value="<?php echo isset($customer) ? $customer :'';?>">                    
                </p>
                <p>
                    <label style="float: left;width: 150px;" for="phone">Số điện thoại</label>
                    <input required class="textInfo" type="text" name="phone" id="phone" value="<?php echo isset($phone) ? $phone :'';?>">
                    <span class="error"><?php echo isset($error['phone']) ? $error['phone'] : ''; ?></span>
                </p>
                <p>
                    <label style="float: left;width: 150px;" for="email">Email</label>
                    <input required class="textInfo" type="text" name="email" id="email" value="<?php echo isset($email) ? $email :'';?>">
                    <span class="error"><?php echo isset($error['email']) ? $error['email'] : ''; ?></span>
                </p>
                <p>
                    <label style="float: left;width: 150px;" for="address">Địa chỉ</label>
                    <input required class="textInfo" type="text" name="address" id="address" value="<?php echo isset($address) ? $address :'';?>">
                </p>
                <p>
                    <label style="float: left;width: 150px;" for="note">Ghi chú</label>
                    <textarea class="textInfo" name="note" id="note" cols="20" rows="2"></textarea>
                </p>
        </div>
        <div class="book-info">
            <h3 class="checkout-title">Thông tin sản phẩm</h3>
            <table style="border: 1px solid #ccc;">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th style="text-align:left;">Tiêu đề</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng cộng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($query_sach2)){
                        $i=1; $totalPrice = 0;
                        while($sach=mysqli_fetch_assoc($query_sach2)){ ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td style="text-align: left;">
                            <span class="cart-name">
                                <?php 
                                    $MaSach = $sach['MaSach'];
                                    $ttsach=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM sach WHERE MaSach='$MaSach'"));
                                    echo $ttsach['TenSach'];
                                ?>
                            </span>
                            </td>
                        <td><span class="cart-price"><?php echo number_format($ttsach['Gia'],0,'.','.');?>đ</span></td>
                        <td><span class="cart-quantity"><?php echo $sach['SoLuong'];?></span></td>
                        <td><?php echo number_format($sach['ThanhTien'],0,'.','.');?>đ</td>
                    </tr>
                    <?php $i++; $totalPrice += $sach['ThanhTien']; }?>
                    
                    <?php }else{ $sach=mysqli_fetch_assoc($query_sach1);?>
                    <tr>
                        <td>1</td>
                        <td style="text-align:left;"><span class="cart-name"><input type="hidden" name="id" value="<?php echo $sach['MaSach'];?>"><?php echo $sach['TenSach'];?></span></td>
                        <td><span class="cart-price"><?php echo number_format($sach['Gia'],0,'.','.');?>đ</span></td>
                        <td><span class="cart-quantity"><?php echo $quantity;?></span></td>
                        <td>
                            <?php
                                $totalPrice = $sach['Gia']*$quantity;
                                echo number_format($totalPrice,0,'.','.');?>đ
                        </td>
                    <?php } ?>
                    </tr>
                    <tr class="transport-price">
                        <td colspan="3"></td>
                        <td>Phí vận chuyển</td>
                        <td colspan="1"><span>22.000đ</span></td>
                    </tr>
                    <tr style="border-top:1px solid #ccc;">
                        <td colspan="3"></td>
                        <td><strong>Tổng cộng</strong></td>
                        <td colspan="1"><strong style="color:red;"><?php echo number_format(($totalPrice+22000),0,'.','.');?>đ</strong><input type="hidden" value="<?php echo $totalPrice;?>" name="totalPrice"></td>
                    </tr>
                    
                </tbody>
            </table>
            <div class="button-wrap">
                <input type="button" class="btn out" value="Quay lại">
                <input type="submit" class="btn checkout" name="submit" value="Đặt hàng">
            </div>
            </form>
        </div>
    </div>
</div>
<?php include './include/footer.php';?>
<?php ob_flush();?>