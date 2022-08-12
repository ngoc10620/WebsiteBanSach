<?php include './include/connection.php';
if(isset($_GET['MaSach'])){
    $MaSach=$_GET['MaSach'];
}else{
    $MaSach='';
}
$sql_sach = "SELECT * FROM sach s INNER JOIN danhmuc d ON s.MaDM = d.MaDM WHERE s.MaSach = '$MaSach'";
$query_sach = mysqli_query($conn,$sql_sach);
$row_sach = mysqli_fetch_assoc($query_sach);
$parent_MaDM = $row_sach['parent_MaDM'];
$sql_list = "SELECT * FROM sach s INNER JOIN danhmuc d ON s.MaDM = d.MaDM WHERE d.parent_MaDM='$parent_MaDM' limit 12";
$query_list = mysqli_query($conn,$sql_list);
$row_number_list = mysqli_num_rows($query_list);
$author=$row_sach['TacGia'];
$sql_author = "SELECT * FROM sach WHERE TacGia = '$author' limit 12";
$query_author = mysqli_query($conn,$sql_author);
$row_number_author = mysqli_num_rows($query_author);
?>
<?php
    $title = $row_sach['TenSach']." - Tác giả: ".$row_sach['TacGia'];
?>
<?php include './include/header.php';?>
<?php include './include/mainnav.php';?>
<style>
.quantity input::-webkit-outer-spin-button,
.quantity input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
</style>
<div class="container">
  <div class="bookdetailwrap">
      <div class="bookdetail clearfix">
          <a href="#" class="image image0">
              <img src="../upload/sach/<?php echo $row_sach['AnhChup'];?>" alt="<?php echo $row_sach['TenSach'];?>">
              <span class="overlay"></span>
          </a>
          <div class="info">
              <h1>
                  <a href="#"><?php echo $row_sach['TenSach'];?></a>
              </h1>
              <div class="intro clearfix">
                  <div class="attributes">
                      <ul>
                          <li class="dataattr">
                              <span>Tác giả: </span>
                              <a href="#"><?php echo $row_sach['TacGia'];?></a>
                          </li>
                          <?php if($row_sach['DichGia'] != NULL){ ?>
                          <li class="dataattr">
                              <span>Dịch giả: </span>
                              <a href="#"><?php echo $row_sach['DichGia'];?></a>
                          </li>
                        <?php } ?>
                          <li class="dataattr">
                              <span>Nhà xuất bản: </span>
                              <a href="#"><?php echo $row_sach['NXB'];?></a>
                          </li>
                      </ul>
                      <ul>
                          <li>Số trang: <?php echo $row_sach['SoTrang'];?></li>
                          <li>Kích thước: <?php echo $row_sach['KichThuoc'];?></li>
                          <li>Ngày phát hành : <?php echo date('d-m-Y',strtotime($row_sach['NgayPhatHanh']));?></li>
                      </ul>
                  </div>
                  <div class="action">
                      <div class="price">
                          <p class="oldprice">
                              Giá bìa: <span><?php echo number_format($row_sach['GiaGoc'],0,'.','.');?>đ</span>
                          </p>
                          <p>Giá Nhã Nam: <span><?php echo number_format($row_sach['Gia'],0,'.','.');?>đ</span> (Đã có VAT)</p>
                      </div>
                      <?php if($row_sach['SoLuongCo'] == 0){ ?>
                                <p style="font-size:20px;font-weight:bold;margin-top:30px;margin-left:70px;">Hết hàng</p>
                            <?php }else{ ?>
                      <div class="quantitytext">Số lượng: </div>
                      <div class="quantity">
                          <input type="hidden" class="id" value="<?php echo $row_sach['MaSach'];?>">
                          <input type="hidden" class="Soluongco" value="<?php echo $row_sach['SoLuongCo'];?>">
                          <input type="number" class="tbQty" value="1" style="color:red;" name="qty">
                          <span class="arrowBlock">
                              <a href="#" class="upQty"></a>
                              <a href="#" class="downQty"></a>
                          </span>
                      </div>
                      <form class="add" method="post">
                            <input type="hidden" class="tbQty" value="1" name="quantity[<?php echo $row_sach['MaSach'];?>]"/>
                            <input type="submit" class="addtocart" value="Thêm vào giỏ hàng">
                        </form>
                      <a class="buynow" href="<?php if(isset($_SESSION['username'])){ echo "Checkout.php?MaSach=".$row_sach['MaSach']."&quantity=1";}else{echo "#";}?>"></a>
                      <?php } ?>
                  </div>
              </div>
          </div>
      </div>
      <div class="bookdetailblockcontent">
          <h1>Giới thiệu sách</h1>
          <article>
              <p>
                  <?php echo $row_sach['MoTa'];?>
              </p>
          </article>
      </div>
      <div class="bookdetailblock bookdetailblockrelated" id="bookrelatecategory">
          <h1>Có thể bạn quan tâm</h1>
          <article>
              <div class="bookslider">
                  <div class="caroufredsel_wrapper">
                      <ul class="clearfix listbook3" id="foo">
                      <?php while($row_list = mysqli_fetch_assoc($query_list)){ ?>
                        <li class="book3 bookimage0">
                            <a href="bookdetail.php?MaSach=<?php echo $row_list['MaSach'];?>" class="image" title="<?php echo $row_list['TenSach'];?>">
                                <img src="../upload/sach/<?php echo $row_list['AnhChup'];?>" alt="<?php echo $row_list['TenSach'];?>">
                            </a>
                        </li>
                      <?php }?>
                      </ul>
                  </div>
                  <a href="#" id="prev1" class="prev" style="display:<?php echo ($row_number_list > 6) ? 'block' : 'none';?>;"><</a>
                  <a href="#" id="next1" class="next" style="display:<?php echo ($row_number_list > 6) ? 'block' : 'none';?>;"><</a>
              </div>
          </article>
      </div>
      <div class="bookdetailblock bookdetailblockrelated" id="bookrelatedauthor">
          <h1>Sách cùng tác giả</h1>
          <article>
          <div class="bookslider">
                  <div class="caroufredsel_wrapper">
                      <ul class="clearfix listbook3" id="foo2">
                      <?php while($row_author = mysqli_fetch_assoc($query_author)){ ?>
                        <li class="book3 bookimage0">
                            <a href="bookdetail.php?MaSach=<?php echo $row_author['MaSach'];?>" class="image" title="<?php echo $row_author['TenSach'];?>">
                                <img src="../upload/sach/<?php echo $row_author['AnhChup'];?>" alt="<?php echo $row_author['TenSach'];?>">
                            </a>
                        </li>
                      <?php }?>
                      </ul>
                  </div>
                  <a href="#" id="prev2" class="prev" style="display:<?php echo ($row_number_author > 6) ? 'block' : 'none';?>;"><</a>
                  <a href="#" id="next2" class="next" style="display:<?php echo ($row_number_author > 6) ? 'block' : 'none';?>;"><</a>
              </div>
          </article>
      </div>
  </div>  
</div>
<script>
    $('.upQty').click(function(){
        var qty=Number($('.tbQty').val());
        var tonkho = Number($('.Soluongco').val());
        var id=$('.id').val();
        if((qty < 20) || (qty < tonkho)){
            qty = qty+1;
            $('.tbQty').val(qty);
            // $(".buynow").attr("Checkout.php?MaSach=" + id + "&quantity=" + qty);
        }
    });
    $('.downQty').click(function(){
        var qty=Number($('.tbQty').val());
        if(qty > 1){
            $('.tbQty').val(qty-1);
        }
    });
    $('.buynow').click(function(){
        var href = $(".buynow").attr("href");
        if(href == "#"){
            alert('Bạn chưa đăng nhập. Hãy đăng nhập để mua ngay!');
        }
        else{
            var qty=Number($('.tbQty').val());
            var tonkho = Number($('.Soluongco').val());
            if(qty <= 0 || isNaN(qty)){
                alert("Số lượng mua phải là số nguyên dương");
                $(".buynow").attr("href","");
            }
            else if(qty>tonkho){
                alert("Số lượng mua nhiều hơn số lượng sách có");
                $(".buynow").attr("href","");
            }
            else{
                var id=$('.id').val();
                $(".buynow").attr("href","Checkout.php?MaSach=" + id + "&quantity=" + qty);
                // window.location.href="Checkout.php?MaSach=" + id + "&quantity=" + qty;
            }
        }
    });
</script>
<?php include './include/footer.php';?>