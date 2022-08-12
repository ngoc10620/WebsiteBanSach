<?php
include '../template/connection.php';
$title = 'Cập nhật tin tức';
include '../template/tpl_header.php';
$query_news = mysqli_query($conn,"SELECT * FROM tintuc");
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
						<li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
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
						Danh sách tin tức
					</h3>
				</div>
				<div class="card-body">
					<table class="table table-bordered table-striped projects" id="TableTinTuc" width="100%">
						<thead>
							<tr>
								<th>STT</th>
								<th>Tiêu đề</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i = 1; 
							while($row_news = mysqli_fetch_assoc($query_news)){ ?>
							<tr data-widget="expandable-table" aria-expanded="false">
								<td><?php echo $i;?></td>
								<td><?php echo $row_news['TieuDe'];?></td>
								<td><a class="btn btn-info btn-sm float-right edittable centered" href="editTin.php?MaTinTuc=<?php echo $row_news['MaTinTuc'];?>"><i class="fas fa-pencil-alt"></i>Sửa</a></td>
							</tr>
                            <tr class="expandable-body">
                                <td colspan="3">
                                    <p><?php echo $row_news['NoiDung'];?></p>
                                </td>
                            </tr>
							<?php $i++; } ?>
						</tbody>
						<tfoot>
							<tr>
                                <th>STT</th>
								<th>Tiêu đề</th>
								<th></th>
							</tr>
						</tfoot>
					</table>
				</div>
				<!-- /.card -->
			</div>
		</div>
	</section>
</div>
<script>
</script>
<?php include '../template/tpl_footer.php';?>