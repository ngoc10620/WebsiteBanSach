<?php
include '../template/connection.php';
$title = 'Sửa tin tức';
include '../template/tpl_header.php';

$MaTinTuc = isset($_GET['MaTinTuc']) ? $_GET['MaTinTuc'] : '';
$query_news = mysqli_query($conn,"SELECT * FROM tintuc WHERE MaTinTuc = '$MaTinTuc'");
$row_news = mysqli_fetch_assoc($query_news);
if(isset($_POST['update'])){
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $sql_update = "UPDATE tintuc SET TieuDe = '$name', NoiDung = '$description' WHERE MaTinTuc = '$MaTinTuc'";
    $query_update = mysqli_query($conn,$sql_update);
    if($query_update){
        $message = 'Cập nhật thông tin thành công.';
    }
    else{
        $message = 'Cập nhật chưa thành công'.mysqli_error($conn);
    }
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-buttons-bs4/2.0.0/buttons.bootstrap4.min.css" integrity="sha512-hzvGZ3Tzqtdzskup1j2g/yc+vOTahFsuXp6X6E7xEel55qInqFQ6RzR+OzUc5SQ9UjdARmEP0g2LDcXA5x6jVQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-responsive-bs4/2.2.5/responsive.bootstrap4.min.css" integrity="sha512-Yy2EzOvLO8+Vs9hwepJPuaRWpwWZ/pamfO4lqi6t9gyQ9DhQ1k3cBRa+UERT/dPzIN/RHZAkraw6Azs4pI0jNg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css" integrity="sha512-3JRrEUwaCkFUBLK1N8HehwQgu8e23jTH4np5NHOmQOobuC4ROQxFwFgBLTnhcnQRMs84muMh0PnnwXlPq5MGjg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 <!-- summernote -->
 <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">
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
						<li class="breadcrumb-item"><a href="sach.php">Tin tức</a></li>
						<li class="breadcrumb-item active"><?php echo $title; ?></li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <form method="post" id="EditSach" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <span style="color: #ff0000; font-style: italic; font-weight: normal;"><?php echo isset($message) ? $message : ''; ?></span>
                        <p>
                            <label for="name">Tiêu đề</label>
                            <input type="text" name="name" class="form-control col-sm-6" placeholder="Tiêu đề" value="<?php echo isset($row_news['TieuDe']) ? $row_news['TieuDe'] : '';?>">
                        </p>
                        <p>
                            <label for="description">Nội dung</label>
                            <textarea name="description" id="summernote"><?php echo isset($row_news['NoiDung']) ? $row_news['NoiDung'] : '';?></textarea>
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-sm-12" style="text-align:center;margin-bottom:20px;">
                    <a href="tintuc.php"><button type="button" class="btn btn-secondary">Trở lại</button></a>
                    <button type="submit" name="update" class="btn btn-primary">Cập nhật</button></div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
<!-- Summernote -->
<script src="../../plugins/summernote/summernote-bs4.min.js"></script>
<script>
$().ready(function() {
    // Summernote
    $('#summernote').summernote()
  })
</script>
<?php include '../template/tpl_footer.php';?>