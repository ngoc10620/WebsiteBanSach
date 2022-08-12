<?php
ob_start();?>
<?php include './include/connection.php';?>
<?php 
if(!isset($_SESSION['username'])){
    echo "<script>alert('Hãy đăng nhập để sử dụng chức năng này');</script>";
    header('Location: login.php');
}
$MaDH = isset($_GET['MaDH']) ? $_GET['MaDH'] : '';
$username = $_SESSION['username'];
$sql_order = "SELECT * FROM taikhoan t INNER JOIN donhang d ON t.MaTK=d.MaTK WHERE d.MaDH='$MaDH'";
$query_order = mysqli_query($conn, $sql_order);
$row_order = mysqli_fetch_assoc($query_order);
if($username != $row_order['TenDangNhap']){
    echo "<script>window.location.href='order.php';alert('Đơn hàng cần tìm không thuộc tài khoản của bạn');</script>";
}
?>
<?php
    $title = "Kiểm tra đơn hàng";
?>
<?php include './include/header.php';?>
<?php include './include/mainnav.php';?>
<?php 
$sql_orderdt = "SELECT * FROM donhang d INNER JOIN chitietdonhang ct ON ct.MaDH=d.MaDH INNER JOIN sach s ON ct.MaSach=s.MaSach WHERE d.MaDH='$MaDH'";
$query_orderdt = mysqli_query($conn,$sql_orderdt);
$sql = "SELECT * FROM donhang WHERE MaDH='$MaDH'";
$query=mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($query);
?>
<div class="container">
    <div class="bookdetailwrap">
        <div class="pageheader">
            <h1>Kiểm tra đơn hàng</h1>
        </div>
        <div class="checkorder">
            <div class="form">
                <form method="get" novalidate="novalidate">
                    <input type="text" class="text" name="MaDH" placeholder="Nhập mã đơn hàng cần tìm" value="<?php echo isset($MaDH) ? $MaDH : '';?>">
                    <input type="submit" class="submit" value="Tìm mã">
                </form>
            </div>
            <div class="info">
                <h3>Thông tin người mua</h3>
                <p>
                    <label>Họ và tên: </label>
                    <strong><?php echo $row_order['HoTenNguoiNhan'];?></strong><br>
                    <label>Địa chỉ: </label>
                    <strong><?php echo $row_order['DiaChiNguoiNhan'];?></strong><br>
                    <label>Trạng thái: </label>
                    <strong><?php switch ($row_order['TinhTrang']) {
                                    case 'canceled':
                                        echo 'Đã hủy';
                                        break;
                                    case 'pending':
                                        echo 'Chờ xử lý';
                                        break;
                                    case 'confirmed':
                                        echo 'Đã xác nhận';
                                        break;
                                    case 'delivered':
                                        echo 'Đang vận chuyển';
                                        break;
                                    case 'completed':
                                        echo 'Đã giao hàng';
                                        break;
                                }?></strong><br>
                </p>
            </div>
            <div class="infodata">
                <h3>Thông tin đơn hàng</h3>
                <p>
                    <label>Ngày mua: </label>
                    <strong><?php echo date('d-m-Y',strtotime($row_order['NgayLap']));?></strong>
                </p>
                <table>
                    <tbody>
                        <tr>
                            <th>STT</th>
                            <th>Tiêu đề</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Tổng cộng</th>
                        </tr>
                    <?php 
                    $i = 1;
                    while($row_orderdt = mysqli_fetch_assoc($query_orderdt)){ ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><a href="bookdetail.php?MaSach=<?php echo $row_orderdt['MaSach'];?>"><?php echo $row_orderdt['TenSach'];?></a></td>
                            <td><?php echo number_format($row_orderdt['Gia'],0,'.','.');?>đ</td>
                            <td><?php echo $row_orderdt['SoLuong'];?></td>
                            <td><?php echo number_format($row_orderdt['ThanhTien'],0,'.','.');?>đ</td>
                        </tr>
                    <?php $i=$i+1; } ?>
                        <tr style="border-top: 1px solid #ccc;">
                            <td style="text-align:right;" colspan="4">
                                <strong>Phí vận chuyển</strong></td>
                            <td><?php echo number_format($row['PhiVanChuyen'],0,'.','.');?>đ</td>
                        </tr>
                        <tr style="border-top: 1px solid #ccc;">
                            <td style="text-align:right;" colspan="4">
                                <strong>Tổng cộng</strong></td>
                            <td><strong style="color:red"><?php $total = $row_order['TongTien'] + $row_order['PhiVanChuyen'];
                                                            echo number_format($total,0,'.','.');?>đ</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include './include/footer.php';?>
<?php ob_flush();?>