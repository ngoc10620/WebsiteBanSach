<?php include './include/connection.php';?>
<?php 
    // Lấy dữ liệu
    $search = $_GET['txtsearch'];
    $sql_search = "SELECT * FROM sach WHERE TenSach LIKE BINARY '%$search%'";
    $query_search = mysqli_query($conn,$sql_search);
    $number_search = mysqli_num_rows($query_search);
?>
<?php
    $title = "Kết quả tìm kiếm: ";
?>
<?php include './include/header.php';?>
<?php include './include/mainnav.php';?>
<div class="container">
    <div class="pagetitle">
        <a href="#">Kết quả tìm kiếm: <?php echo $search;?></a>
    </div>
    <ul class="listbook clearfix">
    <?php if($number_search == 0){ ?>
        <h2 style="text-align:center;margin: 25px auto 30px;margin-left:-50px;">Không tìm thấy cuốn sách nào phù hợp</h4>
    <?php }else{?>
    <?php 
        while($row_search = mysqli_fetch_assoc($query_search)){ ?>
            <li class="book bookimage0">
                <div class="wrap">
                    <a href="bookdetail.php?MaSach=<?php echo $row_search['MaSach'];?>" class="image" title="<?php echo $row_search['TenSach'];?>">
                        <img src="../upload/sach/<?php echo $row_search['AnhChup'];?>" alt="<?php echo $row_search['TenSach'];?>"></a>
                    <div class="popup">
                        <h1 class="name">
                            <a href="#" title="<?php echo $row_search['TenSach'];?>">
                            <?php echo $row_search['TenSach'];?></a>
                        </h1>
                        <div class="description">
                            <ul>
                                <li>Số trang: <?php echo $row_search['SoTrang'];?></li>
                                <li>Kích thước: <?php echo $row_search['KichThuoc'];?></li>
                                <li>Ngày phát hành: <?php echo date('d-m-Y',strtotime($row_search['NgayPhatHanh']));?></li>
                            </ul>
                        </div>
                        <p class="price">
                            <?php echo number_format($row_search['Gia'],0,'.','.');?>đ
                        </p>
                        <a href="#" class="addtocart">Thêm vào giỏ hàng</a>
                        <a href="#" class="buynow">Mua ngay</a>
                    </div>
                </div>
            </li>    
    <?php }  
    }?>
    </ul>
</div>
<?php include './include/footer.php';?>