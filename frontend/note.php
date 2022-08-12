<!-- Modal myCart -->
        <!-- <div class="modal fade hide" id="myCart" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" style="background:rgba(0,0,0,.8);overflow-y:scroll;">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content" style="border: 5px solid rgba(255,255,255,.24);border-radius: 5px;">
                    <!-- Modal Header -->
                    <div class="modal-header"  style="color: #fff; height: 40px;line-height: 40px;font-size: 16px;font-weight:none;text-transform: uppercase;background: url(./img/bg_top.png) repeat-x scroll 50% 0 rgba(0,0,0,0);">
                        <h4 class="modal-title">Giỏ hàng</h4>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> -->
                    <!-- Modal body -->
                    <!-- <div class="modal-body" style="padding:10px; position:relative;">
                    <?php if(mysqli_num_rows($query_gh) == 0){ ?>
                        <p>Không có sản phẩm nào trong giỏ</p>
                    <?php }else { ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th style="text-align:center; width:310px;">Tiêu đề</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Tổng cộng</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row_gh = mysqli_fetch_assoc($query_gh)){ ?>
                                <tr>
                                    <td>1</td>
                                    <td style="text-align: left;"><a href="bookdetail.php?MaSach=<?php echo $row_gh['MaSach'];?>" target="_blank" class="cart-name">Mê cung Thư viện</a></td>
                                    <td><span class="cart-price">134.400đ</span></td>
                                    <td><span class="cart-quantity">1</span>
                                        <a href="#" class="cart-down-quantity frmchangequantity">Down</a>
                                        <a href="#" class="cart-up-quantity frmchangequantity">Up</a>
                                    </td>
                                    <td>134.400đ</td>
                                    <td>
                                        <input type="button" value="Xóa" name="delete">
                                    </td>
                                </tr>
                                <?php } }?>
                                <tr style="border-top:1px solid #ccc;">
                                        <td style="text-align:right;vertical-align:top" colspan="4">
                                            <strong>Tổng cộng</strong>
                                            <br>
                                        </td>
                                        <td colspan="2" style="text-align:left;padding-left:12;vertical-align:top;">
                                            <strong style="color:red;">134.400đ</strong>
                                        </td>
                                </tr>
                            </tbody>
                        <table>
                    </div> -->
                    <!-- Modal footer -->
                    <!-- <button class="btn btn-secondary out" type="button" data-dismiss="modal">Tiếp tục mua hàng</button>
                    <button type="button" class="btn btn-secondary checkout" name="checkout" data-toggle="modal" data-target="#CheckOut">Thanh toán <span class="hidden-mobile">đặt hàng</span></button>
                </div>
            </div>
        </div> -->
        <!-- Modal CheckOut -->
        <!-- <div class="modal fade hide" id="CheckOut" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" style="background:rgba(0,0,0,.8);overflow-y:scroll;">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content" style="border: 5px solid rgba(255,255,255,.24);border-radius: 5px;"> -->
                    <!-- Modal Header -->
                    <!-- <div class="modal-header"  style="color: #fff; height: 40px;line-height: 40px;font-size: 16px;font-weight:none;text-transform: uppercase;background: url(./img/bg_top.png) repeat-x scroll 50% 0 rgba(0,0,0,0);">
                        <h4 class="modal-title">Đơn hàng</h4>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> -->
                    <!-- Modal body -->
                    <!-- <div class="modal-body" style="padding:10px; position:relative;">
                        <div class="customer-info">
                            <h3 class="checkout-title">Thông tin người mua</h3>
                            <form id="infomation">
                                <p>
                                    <label style="float: left;width: 150px;" for="customer">Họ và tên</label>
                                    <input style="padding: 5px;font-size: 12px;width: 250px;border-radius: 3px;border: 1px solid #ccc;" type="text" name="customer" id="customer">
                                </p>
                                <p>
                                    <label style="float: left;width: 150px;" for="phone">Số điện thoại</label>
                                    <input style="padding: 5px;font-size: 12px;width: 250px;border-radius: 3px;border: 1px solid #ccc;" type="text" name="phone" id="phone">
                                </p>
                                <p>
                                    <label style="float: left;width: 150px;" for="email">Email</label>
                                    <input style="padding: 5px;font-size: 12px;width: 250px;border-radius: 3px;border: 1px solid #ccc;" type="text" name="email" id="email">
                                </p>
                                <p>
                                    <label style="float: left;width: 150px;" for="address">Địa chỉ</label>
                                    <input style="padding: 5px;font-size: 12px;width: 250px;border-radius: 3px;border: 1px solid #ccc;" type="text" name="address" id="address">
                                </p>
                                <p>
                                    <label style="float: left;width: 150px;" for="note">Ghi chú</label>
                                    <textarea style="padding: 5px;font-size: 12px;width: 250px;border-radius: 3px;border: 1px solid #ccc;" name="note" id="note" cols="20" rows="2"></textarea>
                                </p>
                            </form>
                        </div>
                        <div class="book-info">
                            <h3 class="checkout-title">Thông tin sản phẩm</h3>
                            <table style="border: 1px solid #ccc;">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th style="text-align:left;">Tiêu đề</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Tổng cộng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td style="text-align: left;"><span class="cart-name">Mê cung Thư viện</span></td>
                                        <td><span class="cart-price">134.400đ</span></td>
                                        <td><span class="cart-quantity">1</span></td>
                                        <td>134.400đ</td>
                                    </tr>
                                    <tr class="transport-price">
                                        <td colspan="3"></td>
                                        <td>Phí vận chuyển</td>
                                        <td colspan="1"><span>22.000đ</span></td>
                                    </tr>
                                    <tr style="border-top:1px solid #ccc;">
                                        <td colspan="3"></td>
                                        <td><strong>Tổng cộng</strong></td>
                                        <td colspan="1"><strong style="color:red;">156.400đ</strong></td>
                                    </tr>
                            </table>
                        </div>
                    </div> -->
                    <!-- Modal footer -->
                    <!-- <div><button style="float:left;width:90px;margin-left:10px;margin-bottom:10px;" class="btn btn-secondary out" type="button" data-dismiss="modal">Quay lại</button>
                    <button style="width:200px;margin-right:10px;margin-bottom:10px;" type="button" class="btn btn-secondary checkout" name="checkout" data-toggle="modal" data-target="#CheckOut">Thanh toán <span class="hidden-mobile">đặt hàng</span></button></div>
                </div>
            </div>
        </div> -->
        <?php
header('Content-Type: application/json');
require_once("./include/connection.php");
// switch ($_GET['action']) {
//     case "add":
//         update_cart();
//         $result=true;
//         echo json_encode($result);
//         break;
//     default:
//         break;
// }

// function update_cart() {
    foreach ($_POST['quantity'] as $MaSach => $quantity) {
        if($quantity != 0){
            $id = $MaSach;
            $user = $_SESSION['username'];
            $row = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM chitietgiohang ct INNER JOIN giohang gh ON ct.MaGioHang = gh.MaGioHang INNER JOIN taikhoan tk ON gh.MaTK = tk.MaTK WHERE tk.TenDangNhap='$user'"));
            $magh = $row['MaGioHang'];
            while($row){
                if($row['MaSach'] == $id){
                    $message = "Đã có sách";
                }
            }
            if(!isset($message)){
                $sach = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM sach WHERE MaSach='$id'"));
                $price = $sach['Gia'] * $quantity;
                $query_add = mysqli_query($conn,"INSERT INTO chitietgiohang(SoLuong,ThanhTien,MaSach,MaGioHang) VALUES ('$quantity','$price','$id','$magh'");
            }else{
                $mactgh = $row['MaCTGH'];
                $price = $row['ThanhTien']/$row['SoLuong'];
                $new_quantity = $row['SoLuong'] + $quantity;
                $new_price = $new_quantity * $price;
                $query_add = mysqli_query($conn,"UPDATE chitietgiohang SET SoLuong='$new_quantity', ThanhTien='$new_price' WHERE MaCTGT='$mactgh'");
            }
        }
    }
// }
?>