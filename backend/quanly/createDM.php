<?php
include '../template/connection.php';
$title = 'Thêm danh mục';
include '../template/tpl_header.php';

$query_parent = mysqli_query($conn,"SELECT * FROM danhmuc WHERE parent_MaDM = '0'");
if(isset($_POST['create'])){
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $parent_id = isset($_POST['parent']) ? $_POST['parent'] : '';
    $sql_create = "INSERT INTO danhmuc (TenDM,parent_MaDM) VALUES ('$name','$parent_id')";
    $query_create = mysqli_query($conn,$sql_create);
    if($query_create){
        echo '<script>alert("Thêm danh mục thành công."); window.location = "danhmuc.php";</script>';
    }
    else{
        echo '<script>alert("Thêm danh mục chưa thành công."); window.location = "createDM.php";</script>';
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
            <form method="post" id="CreateDM" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        
                        <p>
                            <label for="name">Tên danh mục</label>
                            <input type="text" name="name" class="form-control col-sm-6" placeholder="Tên danh mục" value="<?php echo isset($name) ? $name : '';?>">
                        </p>
                        <p>
                            <label for="parent">Danh mục cha</label>
                            <select name="parent" id="parent" class="form-control col-sm-6" required />
                                <option value="" selected>Chọn danh mục cha</option>
                                <option value="0">Không thuộc danh mục nào</option>
                                <?php while($row_parent = mysqli_fetch_assoc($query_parent)){ ?>
                                    <option value="<?php echo $row_parent['MaDM'];?>"><?php echo $row_parent['TenDM'];?></option>
                                <?php } ?>
                            </select>
                        </p>
                    </div>
                    <button type="submit" name="create" class="btn btn-primary">Thêm mới</button>
                </div>
            </form>
        </div>
    </section>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$().ready(function() {
$("#CreateDM").validate({
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
        role: {
            required: 'Vui lòng chọn danh mục cha cho tài khoản'
        }
    }
    });
});
</script>
<?php include '../template/tpl_footer.php';?>