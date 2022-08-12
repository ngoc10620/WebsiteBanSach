<?php
    include '../template/connection.php';
	$MaSach = isset($_GET['MaSach']) ? $_GET['MaSach'] : '';
	$sql_delete = "DELETE FROM sach WHERE MaSach = '$MaSach'";
	$query_delete = mysqli_query($conn,$sql_delete);
	header('location: sach.php');
 ?>