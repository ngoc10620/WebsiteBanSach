<?php
	ob_start();
    include '../template/connection.php';
	$MaDM = isset($_GET['MaDM']) ? $_GET['MaDM'] : '';
	if(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM sach WHERE MaDM = '$MaDM'")) > 0){
		$row_cate = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM danhmuc WHERE MaDM = '$MaDM'"));
		echo '<script>alert("Trong danh mục '.$row_cate['TenDM'].' vẫn còn sách, không thể xóa"); window.location = \'danhmuc.php\';</script>';

	}else{
		$sql_delete = "DELETE FROM danhmuc WHERE MaDM = '$MaDM'";
		$query_delete = mysqli_query($conn,$sql_delete);
	header('location: danhmuc.php');
	}
	ob_flush();
 ?>