<?php 
include './include/connection.php';
if(isset($_GET['MaDM'])){
    $MaDM=$_GET['MaDM'];
}else{
    $MaDM='';
}
$sql_dm = "SELECT * FROM danhmuc WHERE MaDM = '$MaDM'";
$query_dm = mysqli_query($conn,$sql_dm);
$row_dm = mysqli_fetch_assoc($query_dm);
$item_per_page = 20;
$current_page = !empty($_GET['page']) ? $_GET['page'] : 1; 
$offset = ($current_page - 1) * $item_per_page;
$param = "MaDM=$MaDM";
if($row_dm['parent_MaDM'] == 0){
    if(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM danhmuc WHERE parent_MaDM = '$MaDM'")) > 0){
        $sql_sach = "SELECT * FROM sach s INNER JOIN danhmuc d ON s.MaDM = d.MaDM WHERE d.parent_MaDM = '$MaDM' ORDER BY NgayPhatHanh DESC LIMIT $item_per_page OFFSET $offset";
        $totalRecords = mysqli_query($conn, "SELECT * FROM sach s INNER JOIN danhmuc d ON s.MaDM = d.MaDM WHERE d.parent_MaDM = '$MaDM'");
    }
    else{
        $sql_sach = "SELECT * FROM sach s INNER JOIN danhmuc d ON s.MaDM = d.MaDM WHERE s.MaDM = '$MaDM' ORDER BY NgayPhatHanh DESC LIMIT $item_per_page OFFSET $offset";
        $totalRecords = mysqli_query($conn, "SELECT * FROM sach s INNER JOIN danhmuc d ON s.MaDM = d.MaDM WHERE s.MaDM = '$MaDM'");
    }
}
else{
    $sql_sach = "SELECT * FROM sach s INNER JOIN danhmuc d ON s.MaDM = d.MaDM WHERE s.MaDM = '$MaDM' ORDER BY NgayPhatHanh DESC LIMIT $item_per_page OFFSET $offset";
    $totalRecords = mysqli_query($conn, "SELECT * FROM sach s INNER JOIN danhmuc d ON s.MaDM = d.MaDM WHERE s.MaDM = '$MaDM'");
}
$query_sach = mysqli_query($conn,$sql_sach);
$totalRecords = $totalRecords->num_rows;
$totalPages = ceil($totalRecords / $item_per_page);
?>
<?php
    $title = $row_dm['TenDM'];
?>
<?php include './include/header.php';?>
<?php include './include/mainnav.php';?>
<div class="container">
    <div class="pagetitle">
        <a href="#">
            <?php echo $title;?>
        </a>
    </div>
    <ul class="listbook clearfix">
        <?php 
        while($row_sach = mysqli_fetch_assoc($query_sach)){ ?>
            <li class="book bookimage0">
                <div class="wrap">
                    <a href="bookdetail.php?MaSach=<?php echo $row_sach['MaSach'];?>" class="image" title="<?php echo $row_sach['TenSach'];?>">
                        <img src="../upload/sach/<?php echo $row_sach['AnhChup'];?>" alt="<?php echo $row_sach['TenSach'];?>"></a>
                    <div class="popup">
                        <h1 class="name">
                            <a href="#" title="<?php echo $row_sach['TenSach'];?>">
                            <?php echo $row_sach['TenSach'];?></a>
                        </h1>
                        <div class="description">
                            <ul>
                                <li>S??? trang: <?php echo $row_sach['SoTrang'];?></li>
                                <li>K??ch th?????c: <?php echo $row_sach['KichThuoc'];?></li>
                                <li>Ng??y ph??t h??nh: <?php echo date('d-m-Y',strtotime($row_sach['NgayPhatHanh']));?></li>
                            </ul>
                        </div>
                        <p class="price">
                            <?php echo number_format($row_sach['Gia'],0,'.','.');?>??
                        </p>
                        <?php if($row_sach['SoLuongCo'] == 0){ ?>
                            <p style="font-size:20px;font-weight:bold;margin-top:15px;float:right;margin-right:10px;">H???t h??ng</p>
                        <?php }else{ ?>
                            <form class="add" method="post">
                                <input type="hidden" value="1" name="quantity[<?php echo $row_sach['MaSach'];?>]"/>
                                <input type="submit" class="addtocart" value="Th??m v??o gi??? h??ng">
                            </form>
                            <a class="buynow" href="<?php if(isset($_SESSION['username'])){ echo "Checkout.php?MaSach=".$row_sach['MaSach']."&quantity=1";}else{echo "#";}?>">Mua ngay</a>
                        <?php } ?>
                    </div>
                </div>
            </li>    
    <?php } ?>
    <div class="clear-both"></div>
    <?php include './include/pagination.php'; ?>
    </ul>
</div>
<script>
    $(".buynow").click(function(){
                var href = $(".buynow").attr("href");
                if(href == "#"){
                    alert('B???n ch??a ????ng nh???p. H??y ????ng nh???p ????? mua ngay!');
                }
            });
</script>
<?php include './include/footer.php';?>