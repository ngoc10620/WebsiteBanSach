<?php session_start();?>
<?php
$servername = "localhost";
$username = "root";
$password = "111111";
$database = "ql_bansach";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

//Kiểm tra kết nối
if(!$conn)
{
	echo "Lỗi kết nối";
	exit();
}
mysqli_query($conn,"set names utf8");
date_default_timezone_set('Asia/Ho_Chi_Minh');
?>