<?php
include '../template/connection.php';
$title = 'Quản lý đơn hàng';
include '../template/tpl_header.php';
$query_order = mysqli_query($conn,"SELECT * FROM donhang ORDER BY MaDH DESC");
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css" integrity="sha512-PT0RvABaDhDQugEbpNMwgYBCnGCiTZMh9yOzUsJHDgl/dMhD9yjHAwoumnUk3JydV3QTcIkNDuN40CJxik5+WQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-buttons-bs4/2.0.0/buttons.bootstrap4.min.css" integrity="sha512-hzvGZ3Tzqtdzskup1j2g/yc+vOTahFsuXp6X6E7xEel55qInqFQ6RzR+OzUc5SQ9UjdARmEP0g2LDcXA5x6jVQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-responsive-bs4/2.2.5/responsive.bootstrap4.min.css" integrity="sha512-Yy2EzOvLO8+Vs9hwepJPuaRWpwWZ/pamfO4lqi6t9gyQ9DhQ1k3cBRa+UERT/dPzIN/RHZAkraw6Azs4pI0jNg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<!-- Datepicker -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css" integrity="sha512-3JRrEUwaCkFUBLK1N8HehwQgu8e23jTH4np5NHOmQOobuC4ROQxFwFgBLTnhcnQRMs84muMh0PnnwXlPq5MGjg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
						<li class="breadcrumb-item"><a href="../index.php">Trang chủ</a></li>
						<li class="breadcrumb-item active"><?php echo $title; ?></li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="card card-info">
				<div class="card-header">
					<h3 class="card-title">
						<i class="nav-icon fas fa-calendar-alt"></i>
						Danh sách đơn hàng
					</h3>
				</div>
				<div class="card-body">
					<table class="table table-bordered table-striped projects" id="TableDonHang" width="100%">
						<thead>
							<tr>
								<th>STT</th>
								<th>Mã đơn hàng</th>
								<th>Ngày lập hóa đơn</th>
								<th>Người nhận</th>
								<th>Địa chỉ</th>
								<th>Tổng tiền</th>
								<th>Trạng thái</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i = 1; 
							while($row_order = mysqli_fetch_assoc($query_order)){ ?>
							<tr>
								<td><?php echo $i;?></td>
								<td><a href="DHdetail.php?MaDH=<?php echo $row_order['MaDH'];?>" id="MaDM"><?php echo $row_order['MaDH'];?></a></td>
								<td><?php echo date('d-m-Y',strtotime($row_order['NgayLap']));?></td>
								<td><?php echo $row_order['HoTenNguoiNhan'];?></td>
								<td><?php echo $row_order['DiaChiNguoiNhan'];?></td>
								<td><?php $total = $row_order['TongTien'] + $row_order['PhiVanChuyen'];
                                            echo number_format($total,0,'.','.');?>đ</td>
                                <td>
									<form action="update_status.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $row_order['MaDH']; ?>">
										<select name="status" id="status" required/>
											<option value="canceled" <?php echo ($row_order['TinhTrang']=='canceled') ? 'selected' : '';?>>Đã hủy</option>
											<option value="pending" <?php echo ($row_order['TinhTrang']=='pending') ? 'selected' : '';?>>Chờ xử lý</option>
											<option value="confirmed" <?php echo ($row_order['TinhTrang']=='confirmed') ? 'selected' : '';?>>Đã xác nhận</option>
											<option value="delivered" <?php echo ($row_order['TinhTrang']=='delivered') ? 'selected' : '';?>>Đang vận chuyển</option>
											<option value="completed" <?php echo ($row_order['TinhTrang']=='completed') ? 'selected' : '';?>>Đã giao hàng</option>
										</select>
										<?php if($row_order['TinhTrang'] != 'completed'){ ?>
                                    <button style="margin-left:5px;" name="update" id="updatetable" class="btn btn-info btn-sm float-right edit"><i class="fas fa-pencil-alt"></i>Cập nhật</button>
											<?php } ?>
								</form>
                                </td>
							</tr>
							<?php $i++; } ?>
						</tbody>
						<tfoot>
							<tr>
								<th>STT</th>
								<th>Mã đơn hàng</th>
								<th>Ngày lập hóa đơn</th>
								<th>Người nhận</th>
								<th>Địa chỉ</th>
								<th>Tổng tiền</th>
								<th>Trạng thái</th>
							</tr>
						</tfoot>
					</table>
				</div>
				<!-- /.card -->
			</div>
		</div>
	</section>
</div>
<!-- Datatables -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js" integrity="sha512-OQlawZneA7zzfI6B1n1tjUuo3C5mtYuAWpQdg+iI9mkDoo7iFzTqnQHf+K5ThOWNJ9AbXL4+ZDwH7ykySPQc+A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables-responsive/2.2.7/dataTables.responsive.min.js" integrity="sha512-4ecidd7I1XWwmLVzfLUN0sA0t2It86ti4qwPAzXW7B0/yIScpiOj7uyvFgu/ieGTEFjO5Ho98RZIqt75+ZZhdA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-responsive-bs4/2.2.7/responsive.bootstrap4.min.js" integrity="sha512-OiHNq9acGP68tNJIr1ctDsYv7c2kuEVo2XmB78fh4I+3Wi0gFtZl4lOi9XIGn1f1SHGcXGhn/3VHVXm7CYBFNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Datatable Button -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables-buttons/2.0.0/js/dataTables.buttons.min.js" integrity="sha512-PvgN2o+U/CTkCfOHqtSjTECpgUSY5kZm+VoMF4LN0M2QL8U9qGMrD+YGtpwyKUvhZ6jWNkk5Ldvtd4nucAtkow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-buttons-bs4/2.0.0/buttons.bootstrap4.min.js" integrity="sha512-AijsNe5rDJjziesLO1SWgD0hmRWkETKzOCfEOoqt4l6Rpwfi1JC1WxLDV7eeSniCpRRPup2l+UnruRCA12ChVg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.7.1/jszip.min.js" integrity="sha512-xQBQYt9UcgblF6aCMrwU1NkVA7HCXaSN2oq0so80KO+y68M+n64FOcqgav4igHe6D5ObBLIf68DWv+gfBowczg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.2/pdfmake.min.js" integrity="sha512-Yf733gmgLgGUo+VfWq4r5HAEaxftvuTes86bKvwTpqOY3oH0hHKtX/9FfKYUcpaxeBJxeXvcN4EY3J6fnmc9cA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.2/vfs_fonts.min.js" integrity="sha512-BDZ+kFMtxV2ljEa7OWUu0wuay/PAsJ2yeRsBegaSgdUhqIno33xmD9v3m+a2M3Bdn5xbtJtsJ9sSULmNBjCgYw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables-buttons/2.0.0/js/buttons.print.min.js" integrity="sha512-UthH9WkvNUixebk8yKEFm3Sy+Rm8GbuvxiIMCDs9Cepl+YxhY+LUijPFZshcW7+PHa/HcSFLfSX3fGq1AcglWg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables-buttons/2.0.0/js/buttons.html5.min.js" integrity="sha512-33SxAOPhjjpLMmMGKqLwH2QNDmdxf038OFOq+fOI8p8ghCiOvfv3Bs2wqoj50USQkWBLpvy7+CzT5AHTZWGoNA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js" integrity="sha512-k6/Bkb8Fxf/c1Tkyl39yJwcOZ1P4cRrJu77p83zJjN2Z55prbFHxPs9vN7q3l3+tSMGPDdoH51AEU8Vgo1cgAA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>s

<script>
$(document).ready(function(){
  $("#updatetable").click(function(){
    $.get("demo_test.asp", function(data, status){
      alert("Data: " + data + "\nStatus: " + status);
    });
  });
});
$(function () {
    $("#TableDonHang").DataTable({
      "lengthChange": true,
      "autoWidth": false,
      "responsive": true,
		'columns': [
				{ searchable : false },
				{ },
				{ },
				{ },
				{ },
				{ },
				{
					targets: -1,
					orderable: false,
					searchable : false
				}
			],
		buttons: [
				{
					extend: 'copy', 
					exportOptions: 
					{ columns: ':not(:last-child)', }
				}, 
				{
					extend: 'csv', 
					exportOptions: 
					{ columns: ':not(:last-child)', }
				},
				{
					extend: 'excel', 
					exportOptions: 
					{ columns: ':not(:last-child)', }
				},
				{
					extend: 'pdf', 
					exportOptions: 
					{ columns: ':not(:last-child)', }
				},
				{
					extend: 'print', 
					exportOptions: 
					{ columns: ':not(:last-child)', }
				}
			],
		language: {
			"sProcessing":   "Đang xử lý...",
			"sLengthMenu":   "Xem _MENU_ mục",
			"sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
			"sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
			"sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
			"sInfoFiltered": "(được lọc từ _MAX_ mục)",
			"sInfoPostFix":  "",
			"sSearch":       "Tìm:",
			"sUrl":          "",
			"oPaginate": {
				"sFirst":    "Đầu",
				"sPrevious": "Trước",
				"sNext":     "Tiếp",
				"sLast":     "Cuối"
			}
		}
    }).buttons().container().appendTo('#TableDonHang_wrapper .col-md-6:eq(0)');
  });
</script>
<?php include '../template/tpl_footer.php';?>