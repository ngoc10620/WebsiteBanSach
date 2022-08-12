<?php
include '../template/connection.php';
$title = 'Sửa danh mục';
include '../template/tpl_header.php';

$MaDM = isset($_GET['MaDM']) ? $_GET['MaDM'] : '';
$query_cate = mysqli_query($conn,"SELECT * FROM danhmuc WHERE MaDM = '$MaDM'");
$row_cate = mysqli_fetch_assoc($query_cate);
$query_parent = mysqli_query($conn,"SELECT * FROM danhmuc WHERE parent_MaDM = '0'");
$name = isset($row_cate['TenDM']) ? $row_cate['TenDM'] : '';
$parent_id = isset($row_cate['parent_MaDM']) ? $row_cate['parent_MaDM'] : '';
if(isset($_POST['update'])){
    // Lấy dữ liệu
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $parent_id = isset($_POST['parent']) ? $_POST['parent'] : '';
    $sql_update = "UPDATE danhmuc SET TenDM = '$name', parent_MaDM = '$parent_id' WHERE MaDM = '$MaDM'";
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
						<li class="breadcrumb-item"><a href="danhmuc.php">Danh mục</a></li>
						<li class="breadcrumb-item active"><?php echo $title; ?></li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <form method="post" id="EditTK" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <span style="color: #ff0000; font-style: italic; font-weight: normal;"><?php echo isset($message) ? $message : ''; ?></span>
                        <p>
                            <label for="name">Tên danh mục</label>
                            <input type="text" name="name" class="form-control col-sm-6" placeholder="Tên danh mục" value="<?php echo isset($name) ? $name : '';?>">
                        </p>
                        <p>
                            <label for="parent">Danh mục cha</label>
                            <select name="parent" id="parent" class="form-control col-sm-6" required />
                                <option value="">Chọn danh mục cha</option>
                                <option value="0" <?php echo ($parent_id == 0) ? 'selected' : '';?>>Không thuộc danh mục nào</option>
                                <?php while($row_parent = mysqli_fetch_assoc($query_parent)){ ?>
                                    <option value="<?php echo $row_parent['MaDM'];?>" <?php echo ($parent_id == $row_parent['MaDM']) ? 'selected' : '';?>><?php echo $row_parent['TenDM'];?></option>
                                <?php } ?>
                            </select>
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                    <a href="danhmuc.php"><button type="button" class="btn btn-secondary">Trở lại</button></a>
                    <button type="submit" name="update" class="btn btn-primary">Cập nhật</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$().ready(function() {
$("#EditTK").validate({
    errorClass: 'error',
    errorPlacement: function (error, element) {
      error.insertAfter(element);
    },
    rules: {
        name: "required"
    },
    messages: {
        email: {
            required: 'Vui lòng nhập tên danh mục',
        }
        parent: {
            required: 'Vui lòng chọn danh mục cha cho tài khoản'
        }
    }
    });
});
</script>
<?php include '../template/tpl_footer.php';?>