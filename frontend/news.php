<?php 
include './include/connection.php';
if(isset($_GET['MaTinTuc'])){
    $MaTinTuc=$_GET['MaTinTuc'];
}else{
    $MaTinTuc='';
}
$sql_tt = "SELECT * FROM tintuc WHERE MaTinTuc = '$MaTinTuc'";
$query_tt = mysqli_query($conn,$sql_tt);
$row_tt = mysqli_fetch_assoc($query_tt);
?>
<?php
    $title = $row_tt['TieuDe'];
?>
<?php include './include/header.php';?>
<?php include './include/mainnav.php';?>
<div class="container">
    <div class="bookdetailwrap">
        <div class="pageheader">
            <h1><?php echo $row_tt['TieuDe'];?></h1>
        </div>
        <article class="articledetail">
            <?php echo $row_tt['NoiDung'];?>
        </article>
    </div>
</div>
<?php include './include/footer.php';?>