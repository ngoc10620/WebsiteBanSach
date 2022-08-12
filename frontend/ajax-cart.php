<?php
        include './include/connection.php';
        $username = $_SESSION['username'];
        $sql_ctgh = "SELECT * FROM chitietgiohang ct INNER JOIN giohang gh ON ct.MaGioHang = gh.MaGioHang INNER JOIN taikhoan tk ON gh.MaTK = tk.MaTK WHERE tk.TenDangNhap='$username';";
        $query_ctgh = mysqli_query($conn,$sql_ctgh);
        ?>
<style>
.fancybox-can-pan .fancybox-content, .fancybox-can-swipe .fancybox-content {
    cursor: unset;
}
.fancybox-slide--html .fancybox-close-small {
    color:white;
}
#ajax-cart{
    background:rgba(0,0,0,.8);
    padding:0;
    width:880px;
    border-radius:5px;
    border: 5px solid rgba(255,255,255,.24);
}
.container{
    
    border-radius: 5px;
    padding:0;
}
.cart-header{
    color: #fff; 
    height: 40px;
    line-height: 40px;
    font-size: 16px;
    font-weight:none;
    text-transform: uppercase;
    background: url(./img/bg_top.png) repeat-x scroll 50% 0 rgba(0,0,0,0);
}
.cart-title{
    padding:10px;
}
.cart-body{
    background: #fff;
    padding:0;
    border-bottom-left-radius:5px;
    border-bottom-right-radius:5px;
}
tr:last-child td{
    border-top: 1px solid #ccc;
}
.checkout{
    float: right;
    font-size: 13px;
    text-transform: uppercase;
    font-weight: bold;
    margin: 10px;
}
.checkout:hover{
    background: #006400;
}
.cart-name:hover{
    text-decoration: none;
    color: #cf6b50;
}
</style>
<div id="ajax-cart">
    <div class="container">
        <div class="cart-header">
            <h4 class="cart-title">Giỏ hàng</h4>
        </div>
        <div class="cart-body">
            <?php if(mysqli_num_rows($query_ctgh) == 0){ ?>
                <h4 style="margin-bottom:0;padding:10px;">Không có sản phẩm nào trong giỏ</h4>
            <?php }else{ ?>
            <form id="cart-form" action="cart.php?action=submit" method="POST">
                <table>
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th style="text-align:left; width:310px;">Tiêu đề</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Tổng cộng</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i=1; $total =0;
                        while($row_ctgh = mysqli_fetch_assoc($query_ctgh)){ ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td style="text-align: left;">
                                <a href="bookdetail.php?MaSach=<?php echo $row_ctgh['MaSach'];?>" target="_blank" class="cart-name">
                                    <?php 
                                        $MaSach = $row_ctgh['MaSach'];
                                        $sach=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM sach WHERE MaSach='$MaSach'"));
                                        echo $sach['TenSach'];
                                    ?>
                                </a>
                            </td>
                            <td><span class="cart-price"><?php echo number_format($sach['Gia'],0,'.','.');?>đ</span></td>
                            <td><span class="cart-quantity">
                                <form class="updateCart" method="post">
                                    <input type="number" class="cart_qty" value="<?php echo $row_ctgh['SoLuong'];?>" name="quantity[<?php echo $row_ctgh['MaCTGH'];?>]" style="width:40px;">
                                </form>
                                <!-- <a href="#" class="cart-down-quantity frmchangequantity">Down</a>
                                <a href="#" class="cart-up-quantity frmchangequantity">Up</a> -->
                            </td>
                            <td><?php echo number_format($row_ctgh['ThanhTien'],0,'.','.');?>đ</td>
                            <td class="padding:0;margin:0">
                                <form class="delete" method="post">
                                    <input type="hidden" value="<?php echo $row_ctgh['MaCTGH'];?>" name="MaCTGH">
                                <input type="submit" value="Xóa" name="delete" style="border:1px solid black;border-radius:2px;padding-left:1px;padding-right:1px;">
                                </form>
                            </td>
                        </tr>
                    <?php $i++; $total+=$row_ctgh['ThanhTien']; }?>
                        <tr style="border-top:1px solid #ccc;">
                            <td style="text-align:right;vertical-align:top" colspan="4">
                                <strong>Tổng cộng</strong><br>
                            </td>
                            <td colspan="2" style="text-align:center;padding-left:12;vertical-align:top;">
                                <strong style="color:red;" class="total">
                                <?php 
                                    echo number_format($total,0,'.','.');
                                ?>đ
                                </strong>
                            </td>
                        </tr>
                    </tbody>
                <table>
            </form>
            <div class="cart-footer">
                <a href="Checkout.php" class="btn checkout" name="checkout">Thanh toán <span class="hidden-mobile">đặt hàng</span></a>
            </div>
            <?php }?>
        </div>
    </div>
</div>
<script>
    $(".delete").submit(function(event){
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: './updateCart.php?action=delete',
            data: $(this).serializeArray(),
            success: function (response){
                if(response.success){
                    $.fancybox.close(true);
                    $("#cart").fancybox().trigger('click');
                }
                else{
                    alert(response.error);
                }
            }
        })
    });
    $(".cart_qty").change(function(event){
        var qty = Number($(".cart_qty").val());
        if (isNaN(qty) || qty <= 0) {
            $(".cart_qty").val(1);
        }
        $.ajax({
            type: 'POST',
            url: './updateCart.php?action=update',
            data: $(this).serializeArray(),
            success: function (response) {
                if(response.success){
                    $.fancybox.close(true);
                    $("#cart").fancybox().trigger('click');
                }
                else{
                    alert(response.error);
                }
            }
        });
    });
</script>
