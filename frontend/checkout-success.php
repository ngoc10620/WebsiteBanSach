<?php
ob_start();?>
<?php include './include/connection.php';?>
<?php
    $title = "Mua hàng thành công";
?>
<?php include './include/header.php';?>
<?php include './include/mainnav.php';?>
<?php 
// $madh = isset($_GET['madh']) ? $_GET['madh'] : ''; 
?>
<div class="container">
    <div class="bookdetailwrap">
        <h3 style="text-align:center;">Mua hàng thành công. </h3>
        <h3 style="text-align:center;"><a href="order.php">Kiểm tra đơn hàng</a></h3>
        
    </div>
</div>
<?php include './include/footer.php';?>
<?php ob_flush();?>