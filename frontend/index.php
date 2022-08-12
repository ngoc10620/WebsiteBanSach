<?php include './include/connection.php';?>
<?php
    $title = "Trang chủ";
?>
<?php include './include/header.php';?>
<?php include './include/mainnav.php';?>
<?php
$sql_moixb = "SELECT * FROM sach ORDER BY NgayPhatHanh DESC limit 10";
$query_moixb = mysqli_query($conn,$sql_moixb);
$sql_banchay = "SELECT * FROM sach ORDER BY SoLuongBan DESC limit 10";
$query_banchay = mysqli_query($conn,$sql_banchay);
?>
<div class="container">
    <div class="pagetitle">
        <a href="listbook2.php?id=1">Sách mới xuất bản</a>
    </div>
    <ul class="listbook clearfix">
        <?php 
        while($row_moixb = mysqli_fetch_assoc($query_moixb)){ ?>
            <li class="book bookimage0">
                <div class="wrap">
                    <a href="bookdetail.php?MaSach=<?php echo $row_moixb['MaSach'];?>" class="image" title="<?php echo $row_moixb['TenSach'];?>">
                        <img src="../upload/sach/<?php echo $row_moixb['AnhChup'];?>" alt="<?php echo $row_moixb['TenSach'];?>"></a>
                    <div class="popup">
                        <h1 class="name">
                            <a href="#" title="<?php echo $row_moixb['TenSach'];?>">
                            <?php echo $row_moixb['TenSach'];?></a>
                        </h1>
                        <div class="description">
                            <ul>
                                <li>Số trang: <?php echo $row_moixb['SoTrang'];?></li>
                                <li>Kích thước: <?php echo $row_moixb['KichThuoc'];?></li>
                                <li>Ngày phát hành: <?php echo date('d-m-Y',strtotime($row_moixb['NgayPhatHanh']));?></li>
                            </ul>
                        </div>
                        <p class="price">
                            <?php echo number_format($row_moixb['Gia'],0,'.','.');?>đ
                        </p>
                        <?php if($row_moixb['SoLuongCo'] == 0){ ?>
                                <p style="font-size:20px;font-weight:bold;margin-top:15px;float:right;margin-right:10px;">Hết hàng</p>
                            <?php }else{ ?>
                                <form class="add" method="post">
                                    <input type="hidden" value="1" name="quantity[<?php echo $row_moixb['MaSach'];?>]"/>
                                    <input type="submit" class="addtocart" value="Thêm vào giỏ hàng">
                                </form>
                                <a class="buynow" href="<?php if(isset($_SESSION['username'])){ echo "Checkout.php?MaSach=".$row_moixb['MaSach']."&quantity=1";}else{echo "#";}?>">Mua ngay</a>
                            <?php } ?>
                    </div>
                </div>
            </li>    
    <?php } ?>
    </ul>
    <div class="pagetitle">
        <a href="listbook2.php?id=2">Sách bán chạy</a>
    </div>
    <ul class="listbook clearfix">
        <?php 
        while($row_banchay = mysqli_fetch_assoc($query_banchay)){ ?>
            <li class="book bookimage0">
                <div class="wrap">
                    <a href="bookdetail.php?MaSach=<?php echo $row_banchay['MaSach'];?>" class="image" title="<?php echo $row_banchay['TenSach'];?>">
                        <img src="../upload/sach/<?php echo $row_banchay['AnhChup'];?>" alt="<?php echo $row_banchay['TenSach'];?>"></a>
                    <div class="popup">
                        <h1 class="name">
                            <a href="#" title="<?php echo $row_banchay['TenSach'];?>">
                            <?php echo $row_banchay['TenSach'];?></a>
                        </h1>
                        <div class="description">
                            <ul>
                                <li>Số trang: <?php echo $row_banchay['SoTrang'];?></li>
                                <li>Kích thước: <?php echo $row_banchay['KichThuoc'];?></li>
                                <li>Ngày phát hành: <?php echo date('d-m-Y',strtotime($row_banchay['NgayPhatHanh']));?></li>
                            </ul>
                        </div>
                        <p class="price">
                            <?php echo number_format($row_banchay['Gia'],0,'.','.');?>đ
                        </p>
                        <?php if($row_banchay['SoLuongCo'] == 0){ ?>
                                <p style="font-size:20px;font-weight:bold;margin-top:15px;float:right;margin-right:10px;">Hết hàng</p>
                            <?php }else{ ?>
                                <form class="add" method="post">
                                    <input type="hidden" value="1" name="quantity[<?php echo $row_banchay['MaSach'];?>]"/>
                                    <input type="submit" class="addtocart" value="Thêm vào giỏ hàng">
                                </form>
                                <a class="buynow" href="<?php if(isset($_SESSION['username'])){ echo "Checkout.php?MaSach=".$row_banchay['MaSach']."&quantity=1";}else{echo "#";}?>">Mua ngay</a>
                            <?php } ?>
                    </div>
                </div>
            </li>    
    <?php } ?>
    </ul>
    <?php
    foreach ($danhmuc as $key => $item)
    {
        if ($item['parent_MaDM'] == 0)
        {
            $MaDM = $item['MaDM'];
            if(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM danhmuc WHERE parent_MaDM = '$MaDM'")) > 0){
                $sql_sach = "SELECT * FROM sach s INNER JOIN danhmuc d ON s.MaDM = d.MaDM WHERE d.parent_MaDM = '$MaDM' ORDER BY NgayPhatHanh DESC limit 10";
            }
            else{
                $sql_sach = "SELECT * FROM sach s INNER JOIN danhmuc d ON s.MaDM = d.MaDM WHERE s.MaDM = '$MaDM' ORDER BY NgayPhatHanh DESC limit 10";
            }
            $query_sach = mysqli_query($conn,$sql_sach); ?>
            <div class="pagetitle">
                <a href="listbook.php?MaDM=<?php echo $item['MaDM'];?>"><?php echo $item['TenDM'];?></a>
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
                                    <li>Số trang: <?php echo $row_sach['SoTrang'];?></li>
                                    <li>Kích thước: <?php echo $row_sach['KichThuoc'];?></li>
                                    <li>Ngày phát hành: <?php echo date('d-m-Y',strtotime($row_sach['NgayPhatHanh']));?></li>
                                </ul>
                            </div>
                            <p class="price">
                                <?php echo number_format($row_sach['Gia'],0,'.','.');?>đ
                            </p>
                            <?php if($row_sach['SoLuongCo'] == 0){ ?>
                                <p style="font-size:20px;font-weight:bold;margin-top:15px;float:right;margin-right:10px;">Hết hàng</p>
                            <?php }else{ ?>
                                <form class="add" method="post">
                                    <input type="hidden" value="1" name="quantity[<?php echo $row_sach['MaSach'];?>]"/>
                                    <input type="submit" class="addtocart" value="Thêm vào giỏ hàng">
                                </form>
                                <a class="buynow" href="<?php if(isset($_SESSION['username'])){ echo "Checkout.php?MaSach=".$row_sach['MaSach']."&quantity=1";}else{echo "#";}?>">Mua ngay</a>
                            <?php } ?>
                        </div>
                    </div>
                </li>    
            <?php } ?>
            </ul>
        <?php }
    } ?>
</div>
<script>
    $(".buynow").click(function(){
                var href = $(".buynow").attr("href");
                if(href == "#"){
                    alert('Bạn chưa đăng nhập. Hãy đăng nhập để mua ngay!');
                }
            });
</script>
<?php include './include/footer.php';?>