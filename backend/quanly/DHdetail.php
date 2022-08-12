<?php
include '../template/connection.php';
$title = 'Chi tiết đơn hàng';
include '../template/tpl_header.php';

$MaDH = isset($_GET['MaDH']) ? $_GET['MaDH'] : '';
$query_order = mysqli_query($conn,"SELECT * FROM donhang WHERE MaDH = '$MaDH'");
$row_order = mysqli_fetch_assoc($query_order);
$sql_orderdt = "SELECT * FROM donhang d INNER JOIN chitietdonhang ct ON ct.MaDH=d.MaDH INNER JOIN sach s ON ct.MaSach=s.MaSach WHERE d.MaDH='$MaDH'";
$query_orderdt = mysqli_query($conn,$sql_orderdt);
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
						<li class="breadcrumb-item"><a href="donhang.php">Đơn hàng</a></li>
						<li class="breadcrumb-item active"><?php echo $title; ?></li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
        <div class="info">
                <h4>Thông tin người mua</h4>
                <p>
                    <label><strong>Họ và tên: </strong></label>
                    <?php echo $row_order['HoTenNguoiNhan'];?><br>
                    <label><strong>Địa chỉ: </strong></label>
                    <?php echo $row_order['DiaChiNguoiNhan'];?><br>
                    <label><strong>Trạng thái: </strong></label>
                    <?php switch ($row_order['TinhTrang']) {
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
                                }?><br>
                </p>
            </div>
            <div class="infodata">
                <h4>Thông tin đơn hàng</h4>
                <p>
                    <label><strong>Ngày mua: </strong></label>
                    <?php echo date('d-m-Y',strtotime($row_order['NgayLap']));?>
                </p>
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>STT</th>
                            <th>Tiêu đề</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Tổng cộng</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $i = 1;
                    while($row_orderdt = mysqli_fetch_assoc($query_orderdt)){ ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row_orderdt['TenSach'];?></td>
                            <td><?php echo number_format($row_orderdt['Gia'],0,'.','.');?>đ</td>
                            <td><?php echo $row_orderdt['SoLuong'];?></td>
                            <td><?php echo number_format($row_orderdt['ThanhTien'],0,'.','.');?>đ</td>
                        </tr>
                    <?php $i=$i+1; } ?>
                        <tr style="border-top: 1px solid #ccc;">
                            <td style="text-align:right;" colspan="4">
                                <strong>Phí vận chuyển</strong></td>
                            <td><?php echo number_format($row_order['PhiVanChuyen'],0,'.','.');?>đ</td>
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
    </section>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php include '../template/tpl_footer.php';?>