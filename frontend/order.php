<?php
ob_start();?>
<?php include './include/connection.php';?>
<?php 
if(!isset($_SESSION['username'])){
    header('Location: login.php');
}
?>
<?php
    $title = "Kiểm tra đơn hàng";
?>
<?php include './include/header.php';?>
<?php include './include/mainnav.php';?>
<?php 
$username = $_SESSION['username'];
$sql_order = "SELECT * FROM donhang d INNER JOIN taikhoan t ON d.MaTK=t.MaTK WHERE t.TenDangNhap = '$username' ORDER BY MaDH DESC";
$query_order = mysqli_query($conn,$sql_order);
?>
<div class="container">
    <div class="bookdetailwrap">
        <div class="pageheader">
            <h1>Kiểm tra đơn hàng</h1>
        </div>
        <div class="checkorder">
            <div class="form">
                <form method="get" action="orderdetail.php" novalidate="novalidate">
                    <input type="text" class="text" name="MaDH" placeholder="Nhập mã đơn hàng cần tìm">
                    <input type="submit" class="submit" value="Tìm mã">
                </form>
            </div>
            <table>
                <tbody>
                    <tr>
                        <th>STT</th>
                        <th>Mã đơn hàng</th>
                        <th>Ngày mua</th>
                        <th>Người nhận</th>
                        <th>Địa chỉ</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                    </tr>
                <?php 
                $i = 1;
                while($row_order = mysqli_fetch_assoc($query_order)){ ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><a href="orderdetail.php?MaDH=<?php echo $row_order['MaDH'];?>"><?php echo $row_order['MaDH'];?></a></td>
                        <td><?php echo date('d-m-Y',strtotime($row_order['NgayLap']));?></td>
                        <td><?php echo $row_order['HoTenNguoiNhan'];?></td>
                        <td><?php echo $row_order['DiaChiNguoiNhan'];?></td>
                        <td><?php $total = $row_order['TongTien'] + $row_order['PhiVanChuyen'];
                                    echo number_format($total,0,'.','.');?></td>
                        <td><?php 
                                switch ($row_order['TinhTrang']) {
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
                                }?></td>
                    </tr>
                <?php $i=$i+1; } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include './include/footer.php';?>
<?php ob_flush();?>