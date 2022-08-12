<?php
    include '../template/connection.php';
	$MaTK = isset($_GET['MaTK']) ? $_GET['MaTK'] : '';
	$sql_delete = "DELETE FROM taikhoan WHERE MaTK = '$MaTK'";
	$query_delete = mysqli_query($conn,$sql_delete);
	header('location: taikhoan.php');
 ?>