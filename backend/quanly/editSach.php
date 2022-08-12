<?php
include '../template/connection.php';
$title = 'Sửa sách';
include '../template/tpl_header.php';
// Lấy danh sách
$MaSach = isset($_GET['MaSach']) ? $_GET['MaSach'] : '';
$query_book = mysqli_query($conn,"SELECT * FROM sach WHERE MaSach = '$MaSach'");
$row_book = mysqli_fetch_assoc($query_book);
$query_cate = mysqli_query($conn, "SELECT * FROM danhmuc");
// Lấy dữ liệu từ mysql
$name = isset($row_book['TenSach']) ? $row_book['TenSach'] : '';
$cate = isset($row_book['MaDM']) ? $row_book['MaDM'] : '';
$original_price = isset($row_book['GiaGoc']) ? $row_book['GiaGoc'] : '';
$qtityavai = isset($row_book['SoLuongCo']) ? $row_book['SoLuongCo'] : '';
$author = isset($row_book['TacGia']) ? $row_book['TacGia'] : '';
$translator = isset($row_book['DichGia']) ? $row_book['DichGia'] : '';
$publisher = isset($row_book['NXB']) ? $row_book['NXB'] : '';
$date = isset($row_book['NgayPhatHanh']) ? $row_book['NgayPhatHanh'] : '';
$page = isset($row_book['SoTrang']) ? $row_book['SoTrang'] : '';
$size = isset($row_book['KichThuoc']) ? $row_book['KichThuoc'] : '';
$description = isset($row_book['MoTa']) ? $row_book['MoTa'] : '';
$picture = isset($row_book['AnhChup']) ? $row_book['AnhChup'] : '';
// Bấm update
if(isset($_POST['update'])){
    // Lấy dữ liệu từ form
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $cate = isset($_POST['cate']) ? $_POST['cate'] : '';
    $original_price = isset($_POST['price']) ? $_POST['price'] : '';
    $price = $original_price*0.8;
    $qtityavai = isset($_POST['qtityavai']) ? $_POST['qtityavai'] : '';
    $author = isset($_POST['author']) ? $_POST['author'] : '';
    $translator = isset($_POST['translator']) ? $_POST['translator'] : '';
    $publisher = isset($_POST['publisher']) ? $_POST['publisher'] : '';
    $date = isset($_POST['date']) ? $_POST['date'] : '';
    $parts = explode('/', $date);
    $date_2  = "$parts[2]-$parts[1]-$parts[0]";
    $page = isset($_POST['page']) ? $_POST['page'] : '';
    $size = isset($_POST['size']) ? $_POST['size'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $img = isset($_POST['imgname']) ? $_POST['imgname'] : '';
    // Update
    $sql_update = "UPDATE sach SET TenSach = '$name', SoTrang = '$page', KichThuoc = '$size', NgayPhatHanh = '$date_2', Gia='$price', GiaGoc = '$original_price', SoLuongCo = '$qtityavai', MoTa = '$description', AnhChup = '$img', TacGia = '$author', DichGia = '$translator', NXB = '$publisher', MaDM = '$cate' WHERE MaSach = '$MaSach'";
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
<!-- Summernote -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
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
						<li class="breadcrumb-item"><a href="sach.php">Sách</a></li>
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
                    <div class="row">
                        <span style="color: #ff0000; font-style: italic; font-weight: normal;"><?php echo isset($message) ? $message : ''; ?></span>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <p>
                                <label for="name">Tên sách</label>
                                <input type="text" name="name" required class="form-control col-sm-8" placeholder="Tên sách" value="<?php echo isset($name) ? $name : '';?>">
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <p>
                                <label for="cate">Danh mục</label>
                                <select name="cate" id="cate" class="form-control col-sm-8" required />
                                    <option value="">Chọn danh mục</option>
                                    <?php while($row_cate = mysqli_fetch_assoc($query_cate)){
                                        if($row_cate['parent_MaDM'] != 0){ ?>
                                            <option value="<?php echo $row_cate['MaDM'];?>" <?php echo ($row_cate['MaDM'] == $cate) ? 'selected' : '';?>>
                                                <?php $parent_id = $row_cate['parent_MaDM'];
                                                    $row_parent = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM danhmuc WHERE MaDM = '$parent_id'"));
                                                    echo $row_parent['TenDM']; ?> - 
                                                <?php echo $row_cate['TenDM'];?>
                                            </option>
                                    <?php } }?> 
                                </select>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <p>
                                <label for="price">Giá bìa</label>
                                <input type="text" name="price" required class="form-control col-sm-8" placeholder="Giá bìa" value="<?php echo isset($original_price) ? $original_price : '';?>">
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <p>
                                <label for="qtityavai">Số lượng có trong kho</label>
                                <input type="text" name="qtityavai" required class="form-control col-sm-8" placeholder="Số lượng còn" value="<?php echo isset($qtityavai) ? $qtityavai : ''; ?>">
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <p>
                                <label for="author">Tác giả</label>
                                <input type="text" name="author" required class="form-control col-sm-8" placeholder="Tác giả" value="<?php echo isset($author) ? $author : ''; ?>">
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <p>
                                <label for="translator">Dịch giả</label>
                                <input type="text" name="translator" class="form-control col-sm-8" placeholder="Dịch giả" value="<?php echo isset($translator) ? $translator : ''; ?>">
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                        <p>
                                <label for="publisher">Nhà xuất bản</label>
                                <input type="text" name="publisher" required class="form-control col-sm-8" placeholder="Nhà xuất bản" value="<?php echo isset($publisher) ? $publisher : ''; ?>">
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <p>
                                <label>Ngày phát hành:</label>
                                <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                                    <input type="text" name="date" required class="form-control datetimepicker-input col-sm-7" data-target="#datetimepicker4" value="<?php echo date('d-m-Y',strtotime($date));?>"/>
                                    <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <p>
                                <label for="page">Số trang</label>
                                <input type="text" name="page" required class="form-control col-sm-8" placeholder="Số trang" value="<?php echo isset($page) ? $page : ''; ?>">
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <p>
                                <label for="size">Kích thước</label>
                                <input type="text" name="size" required class="form-control col-sm-8" placeholder="Kích thước" value="<?php echo isset($size) ? $size : ''; ?>">
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <p>
                                <label for="exampleInputFile">Ảnh bìa</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Chọn ảnh</label>
                                    </div>
                                </div>
                                <img id="test-img" style="height:120px; margin-top:20px;" src="../../upload/sach/<?php echo $picture;?>" alt="<?php echo $name;?>" />
                                <input type="text" style="display:none;" name="imgname" value="<?php echo $picture;?>" id="imgname"></input>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <p>
                                <label for="description">Mô tả</label>
                                <textarea name="description" id="summernote"><?php echo isset($row_book['MoTa']) ? $row_book['MoTa'] : ''; ?></textarea>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-9" style="text-align:center;margin-bottom:20px;">
                            <a href="sach.php"><button type="button" class="btn btn-secondary">Trở lại</button></a>
                            <button type="submit" name="update" class="btn btn-primary">Cập nhật</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>
<!-- Custom file input -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bs-custom-file-input/1.1.1/bs-custom-file-input.min.js" integrity="sha512-LGq7YhCBCj/oBzHKu2XcPdDdYj6rA0G6KV0tCuCImTOeZOV/2iPOqEe5aSSnwviaxcm750Z8AQcAk9rouKtVSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Datepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/vi.min.js" integrity="sha512-LvYVj/X6QpABcaqJBqgfOkSjuXv81bLz+rpz0BQoEbamtLkUF2xhPNwtI/xrokAuaNEQAMMA1/YhbeykYzNKWg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js" integrity="sha512-k6/Bkb8Fxf/c1Tkyl39yJwcOZ1P4cRrJu77p83zJjN2Z55prbFHxPs9vN7q3l3+tSMGPDdoH51AEU8Vgo1cgAA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$().ready(function() {
// custome file input
bsCustomFileInput.init();
// summernote
$('#summernote').summernote();
// datepicker
$('#datetimepicker4').datetimepicker({
    format: 'L'
    });
});
$('input[type="file"]').on('change', function () {
    var currentImg = this;
    var fileData = currentImg.files[0];
    var formData = new FormData();
    formData.append('img', fileData);
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function () {
        if (ajax.status == 200 && ajax.readyState == 4) {
            var imgPath = "../../upload/sach/" + ajax.responseText;
            var imgName = ajax.responseText;
            $('#test-img').attr('src',imgPath);
            $('#imgname').attr('value',imgName);
        }
    }
    ajax.open("POST", '../../upload/upload.php', true);
    ajax.send(formData);
});
</script>
<?php include '../template/tpl_footer.php';?>